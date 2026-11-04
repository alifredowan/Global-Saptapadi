<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Profiles Table
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // Physical & Personal
            $table->integer('height_cm')->nullable();
            $table->integer('weight_kg')->nullable();
            $table->string('complexion')->nullable();
            $table->string('mother_tongue')->default('Bengali');
            $table->string('citizenship')->default('Bangladesh');
            $table->string('country')->default('Bangladesh');
            $table->string('city')->nullable();
            $table->integer('dependent_children')->default(0);

            // Education & Career
            $table->string('qualification_level')->nullable();
            $table->text('education_detail')->nullable();
            $table->string('profession')->nullable();
            $table->string('organization_type')->nullable(); // Private, Govt, MNC, Business, Self-Employed
            $table->string('annual_income_range')->nullable();

            // Religion, Sect & Lineage
            $table->string('religion')->default('Hindu'); // Hindu, Jain, Sikh, Buddhist
            $table->string('sampradaya')->nullable(); // Vaishnav, Shaiva, Shakta, Smarta, Arya Samaj, ISKCON, Other
            $table->string('caste_jati')->nullable(); // e.g., Bengali Brahmin, Kayastha, Baidya, Mahishya, Khatri, etc.
            $table->string('sub_caste')->nullable(); // e.g., Rarhi, Barendra, Kulin, etc.
            $table->boolean('caste_no_bar')->default(true);
            $table->string('gotra')->nullable(); // Paternal Gotra (e.g. Shandilya, Kashyapa, Bharadwaja, etc.)
            $table->string('nanihal_gotra')->nullable(); // Maternal Gotra

            // Lifestyle & Customary Practices
            $table->string('diet')->default('vegetarian'); // vegetarian, eggetarian, non_vegetarian, jain, vegan
            $table->string('smoking')->default('never'); // never, occasionally, regularly
            $table->string('alcohol')->default('never'); // never, occasionally, regularly
            $table->string('puja_frequency')->default('daily'); // daily, weekly, festivals_only, rarely
            $table->string('temple_visits')->default('weekly'); // daily, weekly, monthly, festivals_only
            $table->string('fasting_vrata')->default('festivals_only'); // regular, ekadashi_only, festivals_only, never
            $table->string('scripture_study')->default('occasional'); // regular, occasional, interested, none
            $table->string('guru_lineage')->nullable();
            $table->string('tilak_preference')->nullable();
            $table->string('post_marriage_customs')->nullable(); // sindoor/mangalsutra preference/acceptance

            // Family Background
            $table->string('family_structure')->default('nuclear'); // nuclear, joint
            $table->string('family_values')->default('moderate'); // traditional, moderate, liberal
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->integer('brothers_count')->default(0);
            $table->integer('sisters_count')->default(0);
            $table->string('native_ancestry')->nullable();
            $table->string('living_arrangements_preference')->default('flexible'); // with_parents, independent, flexible

            // Narrative Bio & Preferences Bio
            $table->text('about_me')->nullable();
            $table->text('partner_preferences_bio')->nullable();

            // Privacy Controls
            $table->string('photo_privacy')->default('blur_until_mutual'); // public, blur_until_mutual, restricted
            $table->boolean('mask_income')->default(false);
            $table->boolean('mask_gotra')->default(false);
            $table->boolean('mask_caste')->default(false);
            $table->boolean('mask_kundli')->default(false);

            // Completeness & Scoring
            $table->integer('profile_completeness_pct')->default(60);

            $table->timestamps();
        });

        // Kundli (Horoscope) Table
        Schema::create('kundlis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('birth_date')->nullable();
            $table->string('birth_time')->nullable(); // hh:mm
            $table->string('birth_place_city')->nullable();
            $table->string('birth_place_country')->nullable();
            $table->string('rashi')->nullable(); // Mesha, Vrishabha, Mithuna, Karka, Simha, Kanya, Tula, Vrishchika, Dhanu, Makara, Kumbha, Meena
            $table->string('nakshatra')->nullable(); // Ashwini, Bharani, Krittika, etc.
            $table->integer('charan')->default(1); // 1, 2, 3, 4
            $table->string('manglik_status')->default('non_manglik'); // non_manglik, manglik, anshik_manglik, unknown
            $table->boolean('horoscope_opt_out')->default(false); // "Horoscope Not Required"
            $table->string('chart_file_path')->nullable(); // uploaded physical kundli chart PDF/image
            $table->boolean('chart_verified_by_pandit')->default(false);
            $table->timestamps();
        });

        // Partner Preferences Table
        Schema::create('partner_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('min_age')->default(20);
            $table->integer('max_age')->default(40);
            $table->integer('min_height_cm')->default(140);
            $table->integer('max_height_cm')->default(200);
            $table->json('marital_status')->nullable();
            $table->json('religions')->nullable();
            $table->json('sampradayas')->nullable();
            $table->boolean('caste_no_bar')->default(true);
            $table->boolean('gotra_exclusion')->default(true); // Exclude same gotra
            $table->boolean('nanihal_gotra_exclusion')->default(false);
            $table->string('manglik_acceptance')->default('any'); // any, manglik_only, non_manglik_only
            $table->json('dietary_preferences')->nullable();
            $table->integer('min_guna_milan_score')->default(18); // Default minimum acceptable score out of 36
            $table->json('preferred_cities')->nullable();
            $table->json('preferred_education')->nullable();
            $table->timestamps();
        });

        // Photos Table
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('photo_path');
            $table->string('blurred_photo_path')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->string('status')->default('approved'); // pending_review, approved, rejected
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Granular Photo Access Grants Table
        Schema::create('photo_access_grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('grantee_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('status')->default('granted'); // granted, revoked
            $table->timestamp('granted_at')->nullable();
            $table->timestamps();
            $table->unique(['owner_user_id', 'grantee_user_id']);
        });

        // Family Representative Delegation Table
        Schema::create('family_representatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seeker_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('rep_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('relationship'); // Father, Mother, Brother, Sister, Uncle, Aunt, Grandparent, Other
            $table->string('permission_scope')->default('approval_required'); // approval_required, read_only_oversight, full_proxy
            $table->boolean('is_verified')->default(true);
            $table->timestamps();
        });

        // Proposals & Interests Table
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('introductory_note')->nullable();
            $table->string('status')->default('pending'); // pending, routed_to_family, family_approved, accepted, declined, cancelled, auto_closed_due_to_marriage
            $table->text('family_rep_notes')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });

        // Messages Table (Chaperoned & Protected)
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('content');
            $table->text('displayed_content'); // regex masked for contact shielding
            $table->boolean('has_masked_contacts')->default(false);
            $table->boolean('dowry_flagged')->default(false);
            $table->string('dowry_flag_details')->nullable();
            $table->string('status')->default('sent'); // sent, delivered, read
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // Formal Contact Exchange Requests (Requires Two-Way Consent)
        Schema::create('contact_exchange_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_a_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('user_b_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('user_a_consent')->default(false);
            $table->boolean('user_b_consent')->default(false);
            $table->string('status')->default('pending'); // pending, mutually_approved, declined
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });

        // Identity Verification (KYC) Table
        Schema::create('identity_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('id_type'); // national_id, passport, voter_id, driving_license
            $table->string('id_number')->nullable();
            $table->string('id_document_path');
            $table->string('selfie_document_path');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
        });

        // Vivah Milestone & Shubho Bibaho Certificate Table
        Schema::create('vivah_milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spouse_a_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('spouse_b_user_id')->constrained('users')->cascadeOnDelete();
            $table->date('wedding_date');
            $table->string('certificate_uuid')->unique();
            $table->string('certificate_path')->nullable();
            $table->string('status')->default('pending_confirmation'); // pending_confirmation, confirmed, rejected
            $table->text('success_story')->nullable();
            $table->string('wedding_photo_path')->nullable();
            $table->boolean('published_to_stories')->default(false);
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
        });

        // Silent Blocking Table
        Schema::create('user_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blocker_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('blocked_id')->constrained('users')->cascadeOnDelete();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->unique(['blocker_id', 'blocked_id']);
        });

        // Moderation & Dowry / Harassment Reporting Table
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reported_id')->constrained('users')->cascadeOnDelete();
            $table->string('category'); // dowry_demand, harassment, fake_profile, inappropriate_content, commercial
            $table->text('details');
            $table->string('status')->default('pending'); // pending, investigating, resolved, dismissed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // Shortlists Table (With Confidential Notes for Pro tier)
        Schema::create('shortlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('candidate_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('confidential_notes')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'candidate_user_id']);
        });

        // Membership Subscriptions Table
        Schema::create('membership_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('plan_name')->default('pro_single_vivah_pass');
            $table->decimal('amount', 10, 2)->default(1499.00);
            $table->string('currency')->default('BDT'); // BDT, INR, USD
            $table->string('payment_method'); // bkash, nagad, upi, card, voucher
            $table->string('transaction_id');
            $table->string('status')->default('completed'); // completed, pending, failed
            $table->boolean('valid_until_marriage')->default(true);
            $table->timestamps();
        });

        // Daily Activity Tracker Table (For Free Explorer Limits: 5 interests/day, 10 views/day)
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('activity_date');
            $table->integer('interests_sent_count')->default(0);
            $table->integer('profiles_viewed_count')->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'activity_date']);
        });

        // Immutable Server Audit Logs Table
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action'); // proposal_sent, proposal_approved, photo_revealed, dowry_flagged, kyc_reviewed, etc.
            $table->json('details')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('daily_activities');
        Schema::dropIfExists('membership_subscriptions');
        Schema::dropIfExists('shortlists');
        Schema::dropIfExists('user_reports');
        Schema::dropIfExists('user_blocks');
        Schema::dropIfExists('vivah_milestones');
        Schema::dropIfExists('identity_verifications');
        Schema::dropIfExists('contact_exchange_requests');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('family_representatives');
        Schema::dropIfExists('photo_access_grants');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('partner_preferences');
        Schema::dropIfExists('kundlis');
        Schema::dropIfExists('profiles');
    }
};

