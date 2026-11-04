<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_sees_landing_dashboard_on_root_url(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sacred Matrimonial Union');
        $response->assertSee('Single Vivah Pass');
        $response->assertSee('36-Point Ashtakoota Guna Milan');
        $response->assertSee('Find Compatible Dharmic Matches');
    }

    public function test_guest_sees_about_us_page(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About Vivah Connect');
        $response->assertSee('5 Sacred Dharmic Pillars');
        $response->assertSee('Pandit Acharya Kalyan');
        $response->assertSee('$29 USD');
    }

    public function test_authenticated_user_redirects_from_root(): void
    {
        $groom = User::where('role', 'groom')->first() ?? User::factory()->create(['role' => 'groom', 'gender' => 'male', 'status' => 'active']);

        $response = $this->actingAs($groom)->get('/');

        $response->assertRedirect(route('discovery.index'));
    }
}
