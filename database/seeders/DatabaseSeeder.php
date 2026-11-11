<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kundli;
use App\Models\PartnerPreference;
use App\Models\FamilyRepresentative;
use App\Models\Proposal;
use App\Models\Message;
use App\Models\IdentityVerification;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with comprehensive Hindu Matrimony demo profiles.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::create([
            'name' => 'Global Saptapadi Admin & Trust Officer',
            'email' => 'admin@globalsaptapadi.com',
            'phone' => '+8801700000000',
            'gender' => 'male',
            'date_of_birth' => '1985-05-15',
            'role' => 'admin',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'pro',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        // 2. Pandit / Ghotok User
        $pandit = User::create([
            'name' => 'Pandit Acharya Kalyan Bhattacharya',
            'email' => 'pandit@globalsaptapadi.com',
            'phone' => '+8801711111111',
            'gender' => 'male',
            'date_of_birth' => '1972-03-20',
            'role' => 'pandit',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'pro',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        // 3. Groom Seeker 1: Dr. Arun Banerjee (Pro Single Vivah Pass, Verified)
        $groom1 = User::create([
            'name' => 'Dr. Arun Banerjee',
            'email' => 'arun@example.com',
            'phone' => '+12125550198',
            'gender' => 'male',
            'date_of_birth' => '1996-06-12', // 30 years old (>=21)
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'pro',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        Profile::create([
            'user_id' => $groom1->id,
            'height_cm' => 178,
            'weight_kg' => 74,
            'complexion' => 'Fair',
            'mother_tongue' => 'English',
            'citizenship' => 'United States',
            'country' => 'United States',
            'city' => 'New York (Manhattan)',
            'qualification_level' => 'Doctorate / MD',
            'education_detail' => 'MD Internal Medicine (Columbia University), Board Certified Physician',
            'profession' => 'Consultant Physician',
            'organization_type' => 'Private Hospital',
            'annual_income_range' => '$60,000 - $85,000 USD / year',
            'religion' => 'Hindu',
            'sampradaya' => 'Vaishnav',
            'caste_jati' => 'Brahmin',
            'sub_caste' => 'Shandilya Lineage',
            'caste_no_bar' => false,
            'gotra' => 'Shandilya',
            'nanihal_gotra' => 'Alambayan',
            'diet' => 'vegetarian',
            'smoking' => 'never',
            'alcohol' => 'never',
            'puja_frequency' => 'daily',
            'temple_visits' => 'weekly',
            'fasting_vrata' => 'regular',
            'scripture_study' => 'regular',
            'guru_lineage' => 'Sri Ramakrishna Mission',
            'family_structure' => 'joint',
            'family_values' => 'traditional',
            'father_occupation' => 'Retired High Court Advocate',
            'mother_occupation' => 'Homemaker',
            'brothers_count' => 1,
            'sisters_count' => 1,
            'native_ancestry' => 'Global Dharmic Diaspora (Heritage: Kolkata Lineage)',
            'living_arrangements_preference' => 'with_parents',
            'about_me' => 'I am a grounded and devout medical professional devoted to healthcare and spiritual values. I value traditional Dharmic sanskar while pursuing professional excellence.',
            'partner_preferences_bio' => 'Looking for an educated, culturally rooted, and kind-hearted Dharmic bride who values family harmony, vegetarian living, and respect for elders.',
            'photo_privacy' => 'public',
            'profile_completeness_pct' => 95,
        ]);

        Kundli::create([
            'user_id' => $groom1->id,
            'birth_date' => '1996-06-12',
            'birth_time' => '07:30',
            'birth_place_city' => 'New York',
            'birth_place_country' => 'United States',
            'rashi' => 'Mesha',
            'nakshatra' => 'Ashwini',
            'charan' => 1,
            'manglik_status' => 'non_manglik',
            'horoscope_opt_out' => false,
            'chart_verified_by_pandit' => true,
        ]);

        PartnerPreference::create([
            'user_id' => $groom1->id,
            'min_age' => 22,
            'max_age' => 28,
            'min_height_cm' => 152,
            'max_height_cm' => 172,
            'caste_no_bar' => false,
            'gotra_exclusion' => true,
            'nanihal_gotra_exclusion' => true,
            'manglik_acceptance' => 'non_manglik_only',
            'dietary_preferences' => ['vegetarian', 'eggetarian'],
            'min_guna_milan_score' => 20,
        ]);

        FamilyRepresentative::create([
            'seeker_user_id' => $groom1->id,
            'rep_user_id' => $pandit->id,
            'relationship' => 'Pandit & Ghotok (Matchmaker)',
            'permission_scope' => 'approval_required',
            'is_verified' => true,
        ]);

        // 4. Groom Seeker 2: Rohit Chatterjee (Software Engineer, Free Explorer)
        $groom2 = User::create([
            'name' => 'Rohit Chatterjee',
            'email' => 'rohit@example.com',
            'phone' => '+447911123456',
            'gender' => 'male',
            'date_of_birth' => '1998-09-18', // 28 years old
            'role' => 'groom',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'free',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        Profile::create([
            'user_id' => $groom2->id,
            'height_cm' => 175,
            'weight_kg' => 70,
            'complexion' => 'Fair',
            'mother_tongue' => 'English',
            'citizenship' => 'United Kingdom',
            'country' => 'United Kingdom',
            'city' => 'London (Canary Wharf)',
            'qualification_level' => 'Masters (M.Sc Software Systems, Imperial College London)',
            'education_detail' => 'Computer Science & Software Architecture',
            'profession' => 'Senior Full-Stack Engineer',
            'organization_type' => 'Global Fintech',
            'annual_income_range' => '$45,000 - $65,000 USD / year',
            'religion' => 'Hindu',
            'sampradaya' => 'Smarta',
            'caste_jati' => 'Khatri',
            'sub_caste' => 'Kashyapa Lineage',
            'caste_no_bar' => true,
            'gotra' => 'Kashyapa',
            'nanihal_gotra' => 'Bharadwaja',
            'diet' => 'vegetarian',
            'smoking' => 'never',
            'alcohol' => 'never',
            'puja_frequency' => 'daily',
            'temple_visits' => 'monthly',
            'family_structure' => 'nuclear',
            'family_values' => 'moderate',
            'father_occupation' => 'College Principal (Retd)',
            'mother_occupation' => 'School Teacher',
            'about_me' => 'Tech enthusiast with strong Dharmic values. I love music, reading philosophy, and building high-impact platforms.',
            'partner_preferences_bio' => 'Seeking an understanding companion with progressive Dharmic outlook. Caste is no bar; mutual respect matters most.',
            'photo_privacy' => 'public',
            'profile_completeness_pct' => 90,
        ]);

        Kundli::create([
            'user_id' => $groom2->id,
            'birth_date' => '1998-09-18',
            'birth_time' => '14:15',
            'birth_place_city' => 'London',
            'birth_place_country' => 'United Kingdom',
            'rashi' => 'Simha',
            'nakshatra' => 'Magha',
            'charan' => 2,
            'manglik_status' => 'non_manglik',
            'horoscope_opt_out' => false,
            'chart_verified_by_pandit' => false,
        ]);

        // 5. Bride Seeker 1: Priya Mukherjee (Lecturer, Father Managed, Photo Blurred until mutual interest)
        $bride1 = User::create([
            'name' => 'Priya Mukherjee',
            'email' => 'priya@example.com',
            'phone' => '+14165550144',
            'gender' => 'female',
            'date_of_birth' => '2001-04-10', // 25 years old (>=18)
            'role' => 'bride',
            'profile_managed_by' => 'father',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'free',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        Profile::create([
            'user_id' => $bride1->id,
            'height_cm' => 163,
            'weight_kg' => 54,
            'complexion' => 'Very Fair',
            'mother_tongue' => 'English',
            'citizenship' => 'Canada',
            'country' => 'Canada',
            'city' => 'Toronto (Ontario)',
            'qualification_level' => 'Masters (M.A. English Literature, University of Toronto)',
            'education_detail' => 'First Class Honors in Comparative Literature',
            'profession' => 'Assistant Professor & Cultural Researcher',
            'organization_type' => 'Public University',
            'annual_income_range' => '$45,000 - $60,000 USD / year',
            'religion' => 'Hindu',
            'sampradaya' => 'Shakta',
            'caste_jati' => 'Brahmin',
            'sub_caste' => 'Shandilya Lineage',
            'caste_no_bar' => true,
            'gotra' => 'Shandilya', // Notice: Same gotra as Dr. Arun (tests same-gotra advisory!)
            'nanihal_gotra' => 'Vatsa',
            'diet' => 'vegetarian',
            'smoking' => 'never',
            'alcohol' => 'never',
            'puja_frequency' => 'daily',
            'temple_visits' => 'weekly',
            'fasting_vrata' => 'festivals_only',
            'scripture_study' => 'regular',
            'family_structure' => 'nuclear',
            'family_values' => 'traditional',
            'father_occupation' => 'Civil Engineering Consultant (Retd)',
            'mother_occupation' => 'Homemaker',
            'brothers_count' => 1,
            'sisters_count' => 0,
            'about_me' => 'Priya is well-mannered, deeply cultured, trained in classical music and literature. Her profile is lovingly managed by her parents.',
            'partner_preferences_bio' => 'Looking for an educated Dharmic groom with dignified family background and progressive yet traditional values.',
            'photo_privacy' => 'blur_until_mutual', // Modesty Blur protection
            'profile_completeness_pct' => 92,
        ]);

        Kundli::create([
            'user_id' => $bride1->id,
            'birth_date' => '2001-04-10',
            'birth_time' => '05:45',
            'birth_place_city' => 'Toronto',
            'birth_place_country' => 'Canada',
            'rashi' => 'Tula',
            'nakshatra' => 'Swati',
            'charan' => 3,
            'manglik_status' => 'non_manglik',
            'horoscope_opt_out' => false,
            'chart_verified_by_pandit' => true,
        ]);

        // 6. Family Representative: Subhash Mukherjee (Priya's Father)
        $fatherRep = User::create([
            'name' => 'Subhash Chandra Mukherjee',
            'email' => 'subhash@example.com',
            'phone' => '+14165550199',
            'gender' => 'male',
            'date_of_birth' => '1960-01-15',
            'role' => 'family_rep',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'free',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        FamilyRepresentative::create([
            'seeker_user_id' => $bride1->id,
            'rep_user_id' => $fatherRep->id,
            'relationship' => 'Father',
            'permission_scope' => 'approval_required', // Proposals require his blessing
            'is_verified' => true,
        ]);

        // 7. Bride Seeker 2: Ananya Roy (Financial Analyst, Independent mode)
        $bride2 = User::create([
            'name' => 'Ananya Roy',
            'email' => 'ananya@example.com',
            'phone' => '+919876543210',
            'gender' => 'female',
            'date_of_birth' => '2000-08-25', // 26 years old
            'role' => 'bride',
            'profile_managed_by' => 'self',
            'marital_status' => 'never_married',
            'is_verified' => true,
            'membership_tier' => 'pro',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        Profile::create([
            'user_id' => $bride2->id,
            'height_cm' => 165,
            'weight_kg' => 56,
            'complexion' => 'Fair',
            'mother_tongue' => 'Bengali',
            'citizenship' => 'India',
            'country' => 'India',
            'city' => 'Mumbai (Bandra)',
            'qualification_level' => 'Masters (MBA in Finance, IIM Ahmedabad)',
            'education_detail' => 'Chartered Financial Analyst (CFA Level 2)',
            'profession' => 'Investment Banking Analyst',
            'organization_type' => 'Global Investment Bank',
            'annual_income_range' => '$40,000 - $55,000 USD / year',
            'religion' => 'Hindu',
            'sampradaya' => 'Smarta',
            'caste_jati' => 'Kayastha',
            'sub_caste' => 'Dakshin Rarhi',
            'caste_no_bar' => true,
            'gotra' => 'Alambayan',
            'nanihal_gotra' => 'Kashyapa',
            'diet' => 'eggetarian',
            'smoking' => 'never',
            'alcohol' => 'never',
            'puja_frequency' => 'weekly',
            'temple_visits' => 'monthly',
            'family_structure' => 'nuclear',
            'family_values' => 'liberal',
            'father_occupation' => 'Bank General Manager',
            'mother_occupation' => 'College Professor',
            'about_me' => 'Independent, ambitious and warm individual. Enjoy Hindustani classical flute, traveling, and quiet family weekends.',
            'partner_preferences_bio' => 'Looking for an ambitious, broad-minded partner who treats marriage as an equal partnership built on mutual trust.',
            'photo_privacy' => 'blur_until_mutual',
            'profile_completeness_pct' => 88,
        ]);

        Kundli::create([
            'user_id' => $bride2->id,
            'birth_date' => '2000-08-25',
            'birth_time' => '10:20',
            'birth_place_city' => 'Mumbai',
            'birth_place_country' => 'India',
            'rashi' => 'Mithuna',
            'nakshatra' => 'Punarvasu',
            'charan' => 2,
            'manglik_status' => 'non_manglik',
            'horoscope_opt_out' => false,
            'chart_verified_by_pandit' => true,
        ]);

        // 8. Bride Seeker 3: Dr. Pooja Das (Baidya, Divorced Remarriage Dignity, ISKCON)
        $bride3 = User::create([
            'name' => 'Dr. Pooja Das',
            'email' => 'pooja@example.com',
            'phone' => '+61412345678',
            'gender' => 'female',
            'date_of_birth' => '1995-11-14', // 31 years old
            'role' => 'bride',
            'profile_managed_by' => 'self',
            'marital_status' => 'divorced', // Non-stigmatising remarriage (URS FR-2.1 & Dignity in Remarriage)
            'is_verified' => true,
            'membership_tier' => 'free',
            'status' => 'active',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
        ]);

        Profile::create([
            'user_id' => $bride3->id,
            'height_cm' => 160,
            'weight_kg' => 52,
            'complexion' => 'Wheatish',
            'mother_tongue' => 'Bengali',
            'citizenship' => 'Australia',
            'country' => 'Australia',
            'city' => 'Sydney (New South Wales)',
            'dependent_children' => 0,
            'qualification_level' => 'Post Graduate (BDS, PGT Orthodontics, University of Sydney)',
            'education_detail' => 'Dental Surgeon',
            'profession' => 'Dental Surgeon & Clinic Owner',
            'organization_type' => 'Self-Employed',
            'annual_income_range' => '$35,000 - $48,000 USD / year',
            'religion' => 'Hindu',
            'sampradaya' => 'ISKCON',
            'caste_jati' => 'Baidya',
            'sub_caste' => 'Kulin',
            'caste_no_bar' => true,
            'gotra' => 'Bharadwaja',
            'nanihal_gotra' => 'Sandilya',
            'diet' => 'vegetarian',
            'smoking' => 'never',
            'alcohol' => 'never',
            'puja_frequency' => 'daily',
            'temple_visits' => 'weekly',
            'fasting_vrata' => 'regular',
            'scripture_study' => 'regular',
            'guru_lineage' => 'Srila Prabhupada disciple lineage',
            'family_structure' => 'nuclear',
            'family_values' => 'moderate',
            'father_occupation' => 'Doctor (Civil Surgeon Retd)',
            'mother_occupation' => 'Homemaker',
            'about_me' => 'A serene soul, dental practitioner, and practitioner of Krishna Consciousness. Seeking a genuine life partner to rebuild a peaceful Dharmic home.',
            'partner_preferences_bio' => 'Open to divorced/widowed/never-married grooms who value spiritual lifestyle and mutual companionship.',
            'photo_privacy' => 'restricted',
            'profile_completeness_pct' => 94,
        ]);

        Kundli::create([
            'user_id' => $bride3->id,
            'birth_date' => '1995-11-14',
            'birth_time' => '18:00',
            'birth_place_city' => 'Sydney',
            'birth_place_country' => 'Australia',
            'rashi' => 'Karka',
            'nakshatra' => 'Pushya',
            'charan' => 4,
            'manglik_status' => 'non_manglik',
            'horoscope_opt_out' => false,
            'chart_verified_by_pandit' => true,
        ]);

        // Create Seed Proposal: Dr. Arun has sent an interest to Priya Mukherjee
        Proposal::create([
            'sender_user_id' => $groom1->id,
            'receiver_user_id' => $bride1->id,
            'introductory_note' => 'Namaskar. With great respect to your esteemed family, I reviewed your daughter\'s profile and find our educational values and Dharmic aspirations deeply resonant. We would be honoured to initiate a conversation.',
            'status' => 'routed_to_family', // Awaiting father Subhash Mukherjee's approval!
            'created_at' => Carbon::now()->subHours(6),
        ]);

        // Create Seed Proposal: Rohit Chatterjee and Ananya Roy have mutual accepted proposal!
        $acceptedProposal = Proposal::create([
            'sender_user_id' => $groom2->id,
            'receiver_user_id' => $bride2->id,
            'introductory_note' => 'Pranam. I was very inspired reading your biodata and your passion for cultural arts and finance. Looking forward to knowing your family better.',
            'status' => 'accepted',
            'responded_at' => Carbon::now()->subDays(2),
            'created_at' => Carbon::now()->subDays(3),
        ]);

        // Seed Chaperoned Messages between Rohit and Ananya
        Message::create([
            'sender_user_id' => $groom2->id,
            'receiver_user_id' => $bride2->id,
            'content' => 'Namaskar Ananya ji. It is a pleasure to connect with you on Global Saptapadi.',
            'displayed_content' => 'Namaskar Ananya ji. It is a pleasure to connect with you on Global Saptapadi.',
            'has_masked_contacts' => false,
            'dowry_flagged' => false,
            'status' => 'read',
            'read_at' => Carbon::now()->subDays(1),
            'created_at' => Carbon::now()->subDays(2),
        ]);

        Message::create([
            'sender_user_id' => $bride2->id,
            'receiver_user_id' => $groom2->id,
            'content' => 'Namaskar Rohit ji! My parents and I reviewed your background. It is lovely that you value literature and classical music alongside software engineering.',
            'displayed_content' => 'Namaskar Rohit ji! My parents and I reviewed your background. It is lovely that you value literature and classical music alongside software engineering.',
            'has_masked_contacts' => false,
            'dowry_flagged' => false,
            'status' => 'read',
            'read_at' => Carbon::now()->subDays(1),
            'created_at' => Carbon::now()->subDays(1),
        ]);

        // Seed KYC records
        IdentityVerification::create([
            'user_id' => $groom1->id,
            'id_type' => 'national_id',
            'id_number' => '19961234567890123',
            'id_document_path' => 'kyc/nid_arun.jpg',
            'selfie_document_path' => 'kyc/selfie_arun.jpg',
            'status' => 'approved',
            'reviewed_by' => $admin->id,
            'reviewed_at' => Carbon::now()->subDays(10),
        ]);

        IdentityVerification::create([
            'user_id' => $bride1->id,
            'id_type' => 'national_id',
            'id_number' => '20019876543210987',
            'id_document_path' => 'kyc/nid_priya.jpg',
            'selfie_document_path' => 'kyc/selfie_priya.jpg',
            'status' => 'approved',
            'reviewed_by' => $admin->id,
            'reviewed_at' => Carbon::now()->subDays(5),
        ]);

        // Audit Log
        AuditLog::log('system_initialized', ['version' => '1.0', 'environment' => 'production'], $admin->id);
    }
}
