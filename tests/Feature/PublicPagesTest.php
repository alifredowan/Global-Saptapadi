<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kundli;
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

    public function test_authenticated_user_redirects_from_root_to_dashboard(): void
    {
        $groom = User::factory()->create(['role' => 'groom', 'gender' => 'male', 'status' => 'active']);

        $response = $this->actingAs($groom)->get('/');

        $response->assertRedirect(route('dashboard'));
    }

    public function test_groom_can_access_groom_dashboard(): void
    {
        $groom = User::factory()->create(['name' => 'Arun Groom', 'role' => 'groom', 'gender' => 'male', 'status' => 'active']);
        Profile::create(['user_id' => $groom->id, 'gotra' => 'Shandilya', 'sampradaya' => 'Vaishnav']);

        $response = $this->actingAs($groom)->get('/groom/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Groom Portal');
        $response->assertSee('Var Dashboard');
        $response->assertSee('Arun Groom');
    }

    public function test_bride_can_access_bride_dashboard(): void
    {
        $bride = User::factory()->create(['name' => 'Priya Bride', 'role' => 'bride', 'gender' => 'female', 'status' => 'active']);
        Profile::create(['user_id' => $bride->id, 'gotra' => 'Kashyapa', 'sampradaya' => 'Smarta']);

        $response = $this->actingAs($bride)->get('/bride/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Bride Portal');
        $response->assertSee('Kanya Dashboard');
        $response->assertSee('Priya Bride');
    }

    public function test_pandit_can_access_pandit_dashboard(): void
    {
        $pandit = User::factory()->create(['name' => 'Acharya Pandit', 'role' => 'pandit', 'gender' => 'male', 'status' => 'active']);

        $response = $this->actingAs($pandit)->get('/pandit/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Pandit & Acharya', false);
        $response->assertSee('Sagotra');
    }

    public function test_cookie_consent_banner_is_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Your privacy, your choice');
        $response->assertSee('We use essential cookies to keep you signed in');
        $response->assertSee('Accept all');
        $response->assertSee('Essential only');
        $response->assertSee('Read our cookie policy');
    }

    public function test_turnstile_captcha_is_rendered_on_login_and_register_pages(): void
    {
        $responseLogin = $this->get('/login');
        $responseLogin->assertStatus(200);
        $responseLogin->assertSee('Success!');
        $responseLogin->assertSee('CLOUDFLARE');
        $responseLogin->assertSee('cf-turnstile-response');

        $responseRegister = $this->get('/register');
        $responseRegister->assertStatus(200);
        $responseRegister->assertSee('Success!');
        $responseRegister->assertSee('CLOUDFLARE');
        $responseRegister->assertSee('cf-turnstile-response');
    }
}
