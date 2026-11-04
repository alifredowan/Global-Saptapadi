<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Carbon\Carbon;

class StatutoryMarriageAgeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * URS FR-1.2: Enforce statutory legal marriage age (21 for males, 18 for females).
     */
    public function test_underage_male_is_barred(): void
    {
        $response = $this->post('/register', [
            'name' => 'Underage Groom',
            'email' => 'underage.male@example.com',
            'phone' => '+8801700000001',
            'gender' => 'male',
            'date_of_birth' => Carbon::now()->subYears(20)->toDateString(), // 20 years old (< 21)
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'anti_bot_verified' => 1,
        ]);

        $response->assertSessionHasErrors('date_of_birth');
        $this->assertDatabaseMissing('users', ['email' => 'underage.male@example.com']);
    }

    public function test_valid_male_age_is_accepted(): void
    {
        $response = $this->post('/register', [
            'name' => 'Legal Age Groom',
            'email' => 'legal.male@example.com',
            'phone' => '+8801700000002',
            'gender' => 'male',
            'date_of_birth' => Carbon::now()->subYears(22)->toDateString(), // 22 years old (>= 21)
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'anti_bot_verified' => 1,
        ]);

        $response->assertRedirect('/profile/edit');
        $this->assertDatabaseHas('users', ['email' => 'legal.male@example.com']);
    }

    public function test_underage_female_is_barred(): void
    {
        $response = $this->post('/register', [
            'name' => 'Underage Bride',
            'email' => 'underage.female@example.com',
            'phone' => '+8801700000003',
            'gender' => 'female',
            'date_of_birth' => Carbon::now()->subYears(17)->toDateString(), // 17 years old (< 18)
            'role' => 'bride',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'anti_bot_verified' => 1,
        ]);

        $response->assertSessionHasErrors('date_of_birth');
        $this->assertDatabaseMissing('users', ['email' => 'underage.female@example.com']);
    }

    /**
     * URS Strict Monogamy Mandate: Married individuals disqualified.
     */
    public function test_married_individual_is_barred(): void
    {
        $response = $this->post('/register', [
            'name' => 'Polygamy Candidate',
            'email' => 'married.user@example.com',
            'phone' => '+8801700000004',
            'gender' => 'male',
            'date_of_birth' => Carbon::now()->subYears(25)->toDateString(),
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'married', // Disqualified
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'anti_bot_verified' => 1,
        ]);

        $response->assertSessionHasErrors('marital_status');
        $this->assertDatabaseMissing('users', ['email' => 'married.user@example.com']);
    }
}
