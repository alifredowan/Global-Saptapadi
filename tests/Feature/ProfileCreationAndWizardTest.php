<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kundli;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileCreationAndWizardTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_renders_with_multistep_wizard(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Sacred Matrimonial Registration');
        $response->assertSee('Candidate Biodata');
        $response->assertSee('Security & Contact', false);
        $response->assertSee('Sacred Pledge');
        $response->assertSee('Global Matrimonial Standards');
        $response->assertSee('UN Convention on Consent to Marriage');
    }

    public function test_user_can_register_and_is_redirected_to_biodata_builder(): void
    {
        $response = $this->post('/register', [
            'name' => 'Devrat Sharma',
            'email' => 'devrat.sharma@example.com',
            'phone' => '+12025550188',
            'gender' => 'male',
            'date_of_birth' => Carbon::now()->subYears(25)->toDateString(),
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'password' => 'VedicSecure#2026',
            'password_confirmation' => 'VedicSecure#2026',
            'anti_bot_verified' => 1,
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertDatabaseHas('users', [
            'email' => 'devrat.sharma@example.com',
            'gender' => 'male',
            'role' => 'groom',
        ]);

        $user = User::where('email', 'devrat.sharma@example.com')->first();
        $this->assertNotNull($user->profile);
        $this->assertNotNull($user->kundli);
    }

    public function test_biodata_builder_renders_all_7_steps(): void
    {
        $user = User::factory()->create([
            'role' => 'groom',
            'gender' => 'male',
            'status' => 'active',
        ]);
        Profile::create([
            'user_id' => $user->id,
            'profile_completeness_pct' => 50,
        ]);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertSee('Sacred Matrimonial Biodata Builder');
        $response->assertSee('1. Basic & Physical', false);
        $response->assertSee('2. Education & Job', false);
        $response->assertSee('3. Gotra & Heritage', false);
        $response->assertSee('4. Lifestyle & Sanskar', false);
        $response->assertSee('5. Family Roots', false);
        $response->assertSee('6. Photos & Modesty', false);
        $response->assertSee('7. Bio & Preferences', false);
        $response->assertSee('Biodata Completeness:');
    }

    public function test_seeker_can_update_biodata_and_recalculate_completeness(): void
    {
        $user = User::factory()->create([
            'role' => 'groom',
            'gender' => 'male',
            'status' => 'active',
        ]);
        $profile = Profile::create([
            'user_id' => $user->id,
            'profile_completeness_pct' => 20,
        ]);

        $response = $this->actingAs($user)->post(route('profile.update'), [
            'height_cm' => 178,
            'city' => 'London',
            'country' => 'United Kingdom',
            'citizenship' => 'British',
            'marital_status' => 'never_married',
            'qualification_level' => 'Master of Science',
            'profession' => 'Software Architect',
            'annual_income_range' => '$100,000 - $150,000 USD',
            'religion' => 'Hindu',
            'sampradaya' => 'Vaishnav',
            'gotra' => 'Kashyapa',
            'diet' => 'vegetarian',
            'puja_frequency' => 'Daily Morning Sandhya',
            'family_structure' => 'nuclear',
            'father_occupation' => 'Physician',
            'about_me' => 'Rooted in Dharmic philosophy and cultural traditions.',
            'partner_preferences_bio' => 'Seeking an educated life partner who values spiritual growth.',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $profile->refresh();

        $this->assertEquals('Kashyapa', $profile->gotra);
        $this->assertEquals('vegetarian', $profile->diet);
        $this->assertGreaterThan(70, $profile->profile_completeness_pct);
    }

    public function test_groom_and_bride_dashboards_render_completeness_card_when_incomplete(): void
    {
        $groom = User::factory()->create(['role' => 'groom', 'gender' => 'male', 'status' => 'active']);
        Profile::create(['user_id' => $groom->id, 'profile_completeness_pct' => 55]);

        $response = $this->actingAs($groom)->get(route('groom.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Complete Your Sacred Biodata');
        $response->assertSee('55% Complete');

        $bride = User::factory()->create(['role' => 'bride', 'gender' => 'female', 'status' => 'active']);
        Profile::create(['user_id' => $bride->id, 'profile_completeness_pct' => 60]);

        $responseBride = $this->actingAs($bride)->get(route('bride.dashboard'));
        $responseBride->assertStatus(200);
        $responseBride->assertSee('Complete Your Sacred Biodata');
        $responseBride->assertSee('60% Complete');
    }
}
