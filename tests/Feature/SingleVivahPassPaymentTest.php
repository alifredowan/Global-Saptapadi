<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\MembershipSubscription;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SingleVivahPassPaymentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can access membership page and see Single Vivah Pass options.
     */
    public function test_user_can_view_membership_single_vivah_pass_page(): void
    {
        $user = User::factory()->create([
            'membership_tier' => 'free',
            'role' => 'seeker',
        ]);

        $response = $this->actingAs($user)->get(route('membership.index'));

        $response->assertStatus(200);
        $response->assertSee('Pro Single Vivah Pass');
        $response->assertSee('Stripe (Card)');
        $response->assertSee('PayPal');
        $response->assertSee('No monthly recurring fees');
    }

    /**
     * Test successful one-time payment via Stripe upgrades seeker to Pro with lifetime-until-marriage validity.
     */
    public function test_seeker_can_purchase_single_vivah_pass_via_stripe(): void
    {
        $user = User::factory()->create([
            'membership_tier' => 'free',
            'role' => 'seeker',
        ]);

        $this->assertFalse($user->isPro());

        $response = $this->actingAs($user)->post(route('membership.stripe'), [
            'cardholder_name' => 'Dr. Rohit Sharma',
            'voucher_code' => 'SHUBHOVIVAH',
        ]);

        $response->assertRedirect(route('membership.index'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue($user->isPro());
        $this->assertEquals('pro', $user->membership_tier);

        // Verify membership subscription record
        $subscription = MembershipSubscription::where('user_id', $user->id)->latest()->first();
        $this->assertNotNull($subscription);
        $this->assertEquals('pro_single_vivah_pass', $subscription->plan_name);
        $this->assertEquals('stripe', $subscription->payment_method);
        $this->assertEquals('19.00', (string) $subscription->amount); // Discount applied
        $this->assertEquals('USD', $subscription->currency);
        $this->assertTrue($subscription->valid_until_marriage);
        $this->assertEquals('completed', $subscription->status);

        // Verify audit log
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $user->id,
            'action' => 'membership_upgraded_to_pro_stripe',
        ]);
    }

    /**
     * Test successful one-time payment via PayPal upgrades seeker to Pro with non-recurring pass.
     */
    public function test_seeker_can_purchase_single_vivah_pass_via_paypal(): void
    {
        $user = User::factory()->create([
            'membership_tier' => 'free',
            'role' => 'seeker',
        ]);

        $this->assertFalse($user->isPro());

        $response = $this->actingAs($user)->post(route('membership.paypal'), [
            'voucher_code' => null,
        ]);

        $response->assertRedirect(route('membership.index'));
        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue($user->isPro());
        $this->assertEquals('pro', $user->membership_tier);

        // Verify subscription in database
        $subscription = MembershipSubscription::where('user_id', $user->id)->latest()->first();
        $this->assertNotNull($subscription);
        $this->assertEquals('pro_single_vivah_pass', $subscription->plan_name);
        $this->assertEquals('paypal', $subscription->payment_method);
        $this->assertEquals('29.00', (string) $subscription->amount); // Full regular price
        $this->assertEquals('USD', $subscription->currency);
        $this->assertTrue($subscription->valid_until_marriage);
        $this->assertEquals('completed', $subscription->status);

        // Verify audit log
        $this->assertDatabaseHas('audit_logs', [
            'user_id' => $user->id,
            'action' => 'membership_upgraded_to_pro_paypal',
        ]);
    }

    /**
     * Test PayPal order creation and capture endpoints.
     */
    public function test_paypal_order_create_and_capture_endpoints(): void
    {
        $user = User::factory()->create([
            'membership_tier' => 'free',
            'role' => 'seeker',
        ]);

        // 1. Create order
        $orderRes = $this->actingAs($user)->postJson(route('membership.paypal.order'), [
            'voucher_code' => 'SHUBHOVIVAH',
        ]);

        $orderRes->assertStatus(200);
        $orderRes->assertJsonStructure(['order_id', 'amount', 'currency']);
        $orderId = $orderRes->json('order_id');
        $this->assertEquals('19.00', $orderRes->json('amount'));

        // 2. Capture order
        $captureRes = $this->actingAs($user)->postJson(route('membership.paypal.capture'), [
            'order_id' => $orderId,
            'payer_id' => 'PAYER_TEST_123',
            'voucher_code' => 'SHUBHOVIVAH',
        ]);

        $captureRes->assertStatus(200);
        $captureRes->assertJson([
            'success' => true,
        ]);

        $user->refresh();
        $this->assertTrue($user->isPro());

        $sub = MembershipSubscription::where('user_id', $user->id)->latest()->first();
        $this->assertEquals($orderId, $sub->transaction_id);
        $this->assertEquals('paypal', $sub->payment_method);
        $this->assertTrue($sub->valid_until_marriage);
    }

    /**
     * Test active Pro member sees their Single Vivah Pass details and DD/MM/YYYY date formatting.
     */
    public function test_active_pro_member_sees_membership_details_and_dd_mm_yyyy_date(): void
    {
        $user = User::factory()->create([
            'membership_tier' => 'pro',
            'role' => 'seeker',
        ]);

        $sub = MembershipSubscription::create([
            'user_id' => $user->id,
            'plan_name' => 'pro_single_vivah_pass',
            'amount' => 29.00,
            'currency' => 'USD',
            'payment_method' => 'stripe',
            'transaction_id' => 'STRIPE_DEMO_998877',
            'status' => 'completed',
            'valid_until_marriage' => true,
        ]);

        $response = $this->actingAs($user)->get(route('membership.index'));

        $response->assertStatus(200);
        $response->assertSee('Pro Member Active');
        $response->assertSee('STRIPE_DEMO_998877');
        $response->assertSee('One-Time (No Monthly Charge)');
        $response->assertSee('Valid Until Marriage');
        $response->assertSee($sub->created_at->format('d/m/Y'));
    }
}
