# Global Saptapadi
### Sacred Dharmic Matrimonial Platform (Worldwide)
> *"Seven steps. One lifetime."*

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-336791?style=flat-square&logo=postgresql&logoColor=white)](https://www.postgresql.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Laravel Reverb](https://img.shields.io/badge/WebSockets-Laravel_Reverb-F59E0B?style=flat-square&logo=socketdotio&logoColor=white)](https://reverb.laravel.com)
[![WCAG AA](https://img.shields.io/badge/WCAG_2.1-AA_Compliant-2F7D4F?style=flat-square)](https://www.w3.org/WAI/WCAG21/quickref/)

---

## Architectural Overview

**Global Saptapadi** is an enterprise-grade matrimonial platform engineered for marriage-oriented Hindu, Jain, Sikh, and Buddhist seekers across North America, the United Kingdom, Europe, the Middle East, Asia-Pacific, and the worldwide Dharmic diaspora.

Rooted in the sacred Vedic tradition of the **Saptapadi** (the Seven Sacred Steps taken around the Agni), the platform replaces commercial "dating-app" mechanics and recurring monthly subscription traps with a dignified, family-chaperoned, and culturally authentic search experience.

```
+-----------------------------------------------------------------------------------------------+
|                                      GLOBAL SAPTAPADI                                         |
+-----------------------------------------------------------------------------------------------+
|     FRONTEND & UI SYSTEM (Tailwind CSS v4, Vedic Token Architecture, English-Only, DD/MM)     |
+-----------------------------------------------+-----------------------------------------------+
|                  LARAVEL 13                   |           LARAVEL REVERB WEBSOCKETS           |
|      (PHP 8.4 REST & Controller Engine)       |          (Port 8085 Real-Time Engine)         |
+-----------------------------------------------+-----------------------------------------------+
| - Statutory Age Verification (21 M / 18 F)    | - Sub-second Real-time Peer Messaging         |
| - 36-Point Ashtakoota Guna Milan Engine       | - Chaperoned 3-Way Family Presence            |
| - Same-Gotra & Nanihal Lineage Advisories     | - Automated Contact Masking (Regex Engine)    |
| - 3-Tier Photo Privacy & Server-side Blur     | - Real-time Anti-Dowry Interception           |
| - Family Representative Delegation System     | - Real-time Typist & Status Broadcasting      |
| - Single Vivah Pass (Stripe & PayPal One-Off) |                                               |
| - Shubho Bibaho Commemorative Registry        |                                               |
| - GDPR, ePrivacy & DPDP Compliance Engine     |                                               |
+-----------------------------------------------+-----------------------------------------------+
|                                    POSTGRESQL 16 DATABASE                                     |
|     (Profiles, Kundlis, Preferences, Proposals, Messages, KYC, Milestones, Audit Logs)       |
+-----------------------------------------------------------------------------------------------+
```

---

## Color Symbolism & Design System

The visual design system of Global Saptapadi is systematically anchored in the sacred color symbolism of Vedic wedding ceremonies. All styling is managed strictly through design tokens (`--color-*`), ensuring complete WCAG AA accessibility and consistent theming.

### 1. Traditional Color Hierarchy
- **Kumkum Maroon (`#8B1E2D` / Hover `#6E1723` — Primary ~50%):** Represents marriage, sindoor, shakti, and auspicious beginnings. Applied to primary CTAs, brand identity, unread badges, and key headings.
- **Agni Saffron (`#E07B1A` / Hover `#BF640E` — Accent ~10%):** Represents Agni (the sacred fire of the Saptapadi), purity, and devotion. Applied to active navigation indicators, 2px focus rings, Pro membership crests, and dark section CTAs.
- **Turmeric Yellow / Haldi (`#F2B01E` / Soft `#FFF5D6` — Secondary Tint):** Represents auspiciousness and joy (Haldi ceremony). Used for alternating section backgrounds, celebratory milestone petal showers, and subtle badges.
- **Tulsi Green (`#2F7D4F` — Semantic Accent <1%):** Represents nature, spiritual growth, and new life. Exclusively reserved for government ID verified badges and success states.
- **Warm Ivory (`#FFFBF3` / `#FFFFFF` — Canvas ~40%):** Represents purity and light. Acts as the primary surface and background canvas.
- **Deep Ink Maroon (`#4A0F1A` to `#330A12` — Dark Surfaces):** Represents auspicious sacred evenings. Powers `.section--dark` footer and call-to-action bands paired with subtle 7% saffron alpona motifs.

### 2. WCAG AA Contrast Verification

| UI Element & Text Combination | Contrast Ratio | Standard Achieved |
| :--- | :--- | :--- |
| **White on Kumkum Maroon Button** (`#FFFFFF` on `#8B1E2D`) | **9.05 : 1** | **WCAG AAA Passed** |
| **Dark Ink on Saffron CTA** (`#330A12` on `#E07B1A`) | **5.88 : 1** | **WCAG AA Passed** |
| **Soft Ivory Body Text on Ink Dark** (`#F3E4DD` on `#4A0F1A`) | **12.33 : 1** | **WCAG AAA Passed** |
| **Pure White Headings on Ink Dark** (`#FFFFFF` on `#4A0F1A`) | **15.28 : 1** | **WCAG AAA Passed** |
| **Near-Black Body Text on Ivory Canvas** (`#1A1A1A` on `#FFFBF3`) | **16.86 : 1** | **WCAG AAA Passed** |
| **Muted Text on Ivory Canvas** (`#4B5563` on `#FFFBF3`) | **7.32 : 1** | **WCAG AAA Passed** |
| **White on Tulsi Green Verified Badge** (`#FFFFFF` on `#2F7D4F`) | **5.04 : 1** | **WCAG AA Passed** |

---

## Standardized Header & Account Controls

Global Saptapadi implements a standardized, high-accessibility header structure ensuring consistent ergonomics across desktop and mobile devices:

### Desktop Header (64px Height)
1. **Left:** Global Saptapadi logo mark and brand text.
2. **Center / Left:** Primary navigation links (Discover, Interests, Shortlist).
3. **Right (Exact Order):**
   - **Messages Icon:** 44×44px hit area with 22px icon, unread counter badge in Kumkum maroon (`#8B1E2D`) with white text.
   - **Notifications Icon:** 44×44px hit area, unread counter badge, opens 360px scrollable 4-tab panel (All, Interests, Messages, Family) with "Mark all as read" footer.
   - **Avatar Menu Button:** User photo or initials with subtle chevron, opening an accessible 260–280px dropdown with ARIA role attributes:
     - *Header Row:* Avatar, full name, Pro/Free badge, and verified badge.
     - *Items:* My Profile, Family Dashboard (for representatives), Admin (for administrators), Settings, Privacy & Cookies, Membership (Pro), Help, divider, and Log Out.

### Mobile Navigation (56px Top Bar + Fixed Bottom Tab Bar)
- **Top Bar:** Brand logo on left; Notifications bell and Avatar menu button on right.
- **Fixed Bottom Tab Bar (5 Tabs):** Discover, Interests, Messages (with live unread badge), Shortlist, and Profile (triggers slide-up account bottom sheet).

---

## Comprehensive Feature Map

### 1. Registration & International Account Verification
- **Statutory Legal Age Enforcement:** Enforces minimum **21 years for grooms** and **18 years for brides** in compliance with statutory civil matrimonial age laws and the **UN Convention on Consent to Marriage**.
- **Strict Monogamy Mandate:** Bigamy and polygamy are barred under international civil codes and Dharmic principles. Supported statuses: **Never Married, Divorced, Widowed, and Annulled**.
- **"Profile Managed By" Attribution:** Transparent declaration indicating whether a profile is candidate-managed or managed by family (Self, Father, Mother, Brother, Sister, Uncle, Aunt, Grandparent, or Relative).
- **International English-Only Platform:** UI, communications, templates, and notifications operate in English worldwide. Sanskrit terms are presented in Latin script (e.g. *Kundli*, *Gotra*, *Manglik*, *Saptapadi*) with plain-English contextual hints.
- **Unambiguous International Dates:** Displayed in unambiguous global formats (`12 Mar 2026`).

### 2. Biodata & Cultural Lineage Architecture
- **Global Residential Data:** Country of residence, citizenship, city/region, height, weight, and mother tongue.
- **Dharmic Communities & Lineage:**
  - Religion (Hindu, Jain, Sikh, Buddhist)
  - Sampradaya (Vaishnav, Shaiva, Shakta, Smarta, ISKCON, Arya Samaj)
  - Caste/Jati and Regional Sub-caste with prominent **"Caste No Bar"** option.
  - Paternal Gotra and Maternal Lineage (Nanihal Gotra).
- **Lifestyle & Customary Practice:**
  - Dietary Practice (Vegetarian, Eggetarian, Non-vegetarian, Jain, Vegan)
  - Devotional Routine: Daily Puja frequency, Temple visits, Fasting (Vrata) observance, Scripture study, and Guru lineage.
- **Family Background:** Structure (Joint / Nuclear), family values (traditional, moderate, liberal), parent occupations, and post-marriage living arrangement preferences.
- **Dynamic Profile Completeness Score:** 0–100% algorithm driving discovery visibility.

### 3. Janam Patrika & 36-Point Ashtakoota Guna Milan
- **Automated Guna Milan Engine:** Full Vedic astrological matching across all 8 Kootas (Total 36 points):
  1. *Varna (1 pt)*: Spiritual affinity and work temperaments.
  2. *Vashya (2 pts)*: Mutual attraction and psychological harmony.
  3. *Tara (3 pts)*: Health, destiny, and longevity from Nakshatra distance.
  4. *Yoni (4 pts)*: Biological and physical affinity.
  5. *Graha Maitri (5 pts)*: Planetary Moon-sign Lord friendship and mental harmony.
  6. *Gana (6 pts)*: Temperament matching (Deva, Manushya, Rakshasa).
  7. *Bhakoot (7 pts)*: Emotional harmony, financial prosperity, and dosha checking.
  8. *Nadi (8 pts)*: Genetic, physiological compatibility (Adi, Madhya, Antya).
- **Manglik Placement Analysis:** Evaluates Mangal Dosha with automated cancellation analysis when both candidates share Manglik placement.
- **Astrology Opt-Out Toggle:** Users may select *"Horoscope Not Required"* to evaluate candidates purely on shared values and lifestyle.
- **Same-Gotra Advisory:** Automated informational advisory when candidates share paternal gotra or maternal lineage.
- **Permission-Gated Chart Upload:** Secure upload of physical Kundli birth charts (PDF/image).

### 4. Photo Privacy & Media Shield
- **Three-Tier Privacy Controls:**
  - *Fully Public*: Visible to all authenticated seekers.
  - *Blurred Until Mutual*: Automatic server-side Gaussian blur; unblurred photo revealed only upon mutual proposal acceptance.
  - *Restricted*: Accessible only through explicit user grant.
- **Server-Side Blur Processing:** Dual-image generation protecting against raw asset leakage in browser inspector tools.

### 5. Family Representative Delegation System
- **Universal Family Representation:** Fathers, mothers, siblings, or elders can act as verified representatives for both grooms and brides.
- **Granular Permission Scopes:** *Approval Required*, *Read-Only Oversight*, or *Full Proxy Management*.
- **Dedicated Family Dashboard:** Displays assigned wards, pending inbound proposals, chaperoned chat monitoring, and polite response macros.
- **Perpetually Free Access:** Family representative accounts are forever 100% free.

### 6. Worldwide Discovery, Matching & Search
- **Strict Opposite-Gender Indexing:** Grooms see Brides only; Brides see Grooms only. Active married users automatically excluded from index.
- **Worldwide Diaspora Filters:** Country / Diaspora Region (United States, United Kingdom, Canada, Australia, India, Singapore, UAE, etc.), City, Min/Max Age, Marital Status, Diet, Gotra exclusion, Sampradaya, Manglik status, and minimum Guna Milan score.
- **Multi-Variable Compatibility Badge:** Displays composite percentage combining lifestyle, values, and astrological points.
- **Private Shortlist Repository:** Pro tier feature with confidential candidate family notes.

### 7. Secure Chaperoned Communication
- **Real-Time Sub-Second Peer Messaging:** Powered by Laravel Reverb WebSockets on port `8085` (`private-chat.{minId}.{maxId}`).
- **Three-Way Guardian Chaperoning:** Allows family elders to view and participate in prospective wedding dialogues.
- **Contact Shielding:** Real-time regex masking of telephone numbers, email addresses, and social media handles.
- **Anti-Dowry & Anti-Extortion Engine:** Scans for and immediately blocks messages containing dowry or commercial asset demands in compliance with international treaties and UN CEDAW.
- **Formal Contact Exchange Channel:** Two-way mutual consent buttons unlocking verified telephone numbers and emails.

### 8. International Safety, KYC Verification & Moderation
- **Multi-Jurisdiction ID Audit:** Machine-readable international passports, state/provincial driver's licenses, and national ID cards paired with live selfie verification.
- **"Verified Seeker" Crest Badge:** Displayed on authenticated biodatas with a Tulsi Green checkmark.
- **Silent Mutual Blocking:** Complete reciprocal invisibility between blocked users.
- **Immutable Server Audit Logs:** Records all administrative, payment, and matrimonial actions.

### 9. Monetization: The Pro "Single Vivah Pass"
- **One-Time Pass for a Single Marriage:** Rejects commercial recurring monthly subscriptions. Pay once for a single marriage search, valid until wedding solemnization.
- **Zero Recurring Fees:** No monthly credit card charges, no automatic renewals, no subscription traps.
- **Integrated Payment Gateways:**
  - **Stripe:** Instant one-time checkout for Visa, MasterCard, and American Express with 256-bit SSL encryption.
  - **PayPal:** PayPal Express Checkout supporting PayPal balance, connected cards, and Pay in 4.
  - Standard price: **$29.00 USD** (or **$19.00 USD** with promotional discount voucher `SHUBHOVIVAH`).

### 10. Vivah Milestone & Shubho Bibaho Certificate
- **Marriage Declaration Workflow:** Candidate selects spouse and enters solemnization date.
- **Commemorative "Shubho Bibaho" Digital Certificate:** High-resolution printable certificate with unique registry UUID, gotras, wedding date (`DD/MM/YYYY`), and blessings.
- **Automated Lifecycle De-Indexing:** Updates status to Married, closes outstanding proposals, revokes photo permissions, and locks chat to read-only.

### 11. Privacy, Cookies & Legal Compliance
- **GDPR & ePrivacy Compliant Cookie Consent Banner:** Granular selection between strictly essential, analytical, and functional cookies with persistent local storage.
- **Transparent Statutory Policies:** Dedicated public pages for [Cookie Policy](http://localhost:5001/cookies), [Privacy Policy](http://localhost:5001/privacy), and [Terms of Service](http://localhost:5001/terms).

---

## Quick Start Guide

### 1. Prerequisites
- **PHP 8.4+** with extensions: `pdo_pgsql`, `pgsql`, `gd`, `intl`, `openssl`, `mbstring`, `fileinfo`.
- **Node.js 20+** and `npm`.
- **PostgreSQL 16+** running on `127.0.0.1:5432` with database `global_saptapadi`.
- **Composer 2.7+**.

### 2. Environment Configuration (`.env`)

Configure your environment settings:
```env
APP_NAME="Global Saptapadi"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:5001

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=global_saptapadi
DB_USERNAME=postgres
DB_PASSWORD=postgres

BROADCAST_CONNECTION=reverb
REVERB_APP_ID=100101
REVERB_APP_KEY=globalsaptapadireverbkey
REVERB_APP_SECRET=globalsaptapadireverbsecret
REVERB_HOST="127.0.0.1"
REVERB_PORT=8085
REVERB_SCHEME="http"

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"

# Stripe Payment Gateway
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_CURRENCY=USD

# PayPal Payment Gateway
PAYPAL_CLIENT_ID=sb_...
PAYPAL_SECRET=sb_...
PAYPAL_MODE=sandbox
PAYPAL_CURRENCY=USD
```

### 3. Database Migration & Worldwide Demo Seeding
```bash
php artisan migrate:fresh --seed
```

### 4. Compiling Frontend Assets
```bash
# Build production bundles
npm run build

# Or run Vite development server
npm run dev
```

### 5. Running the Application

Open separate terminal sessions:

**Terminal 1 (Laravel Web Server on Port 5001):**
```bash
php artisan serve --port=5001
```
*Application URL: `http://127.0.0.1:5001`*

**Terminal 2 (Laravel Reverb WebSocket Server on Port 8085):**
```bash
php artisan reverb:start --port=8085
```
*Reverb Service: `ws://127.0.0.1:8085`*

---

## Seeded Evaluation Demo Accounts

All evaluation accounts share the standard password: **`password123`**. You can log in directly using the quick-persona buttons on the Sign-In screen:

| Role / Persona | Email | Password | Location & Profile Details |
| :--- | :--- | :--- | :--- |
| **Groom (Seeker)** | `arun@example.com` | `password123` | Dr. Arun Banerjee • 30 yrs • MD Physician • Manhattan, New York, **United States** • Shandilya Gotra • Pro Single Vivah Pass • ID Verified |
| **Groom (Seeker)** | `rohit@example.com` | `password123` | Rohit Chatterjee • 28 yrs • Senior Software Engineer • London, **United Kingdom** • Kashyapa Gotra • Free Explorer |
| **Bride (Seeker)** | `priya@example.com` | `password123` | Priya Mukherjee • 25 yrs • Assistant Professor • Toronto, **Canada** • Shandilya Gotra • Modesty Photo Blur • Father Managed |
| **Bride (Seeker)** | `ananya@example.com` | `password123` | Ananya Roy • 26 yrs • Investment Banking Analyst • Mumbai, **India** • Mutual accepted proposal with Rohit |
| **Bride (Remarriage)** | `pooja@example.com` | `password123` | Dr. Pooja Das • 31 yrs • Dental Surgeon • Sydney, **Australia** • Divorced Remarriage Dignity • ISKCON |
| **Family Representative** | `subhash@example.com` | `password123` | Subhash Chandra Mukherjee • Priya's Father • Toronto, **Canada** • Chaperone Approval Dashboard |
| **Pandit / Matchmaker** | `pandit@globalsaptapadi.com` | `password123` | Pandit Acharya Kalyan Bhattacharya • Lineage Advisor & Matchmaker Dashboard |
| **Admin & Trust Officer** | `admin@globalsaptapadi.com` | `password123` | Trust Operations Dashboard, KYC Review Queue, Anti-Dowry Reports & Immutable Audit Logs |

---

## Automated Verification & Test Commands

```bash
# Verify Blade template compilation
php artisan view:cache
php artisan view:clear

# Build Vite frontend assets
npm run build

# Inspect registered routes
php artisan route:list
```

---

## Legal, Statutory & Ethical Standards
- **UN Convention on Consent to Marriage:** Minimum age for marriage (21 for grooms, 18 for brides) strictly enforced; underage registrations barred globally.
- **International Anti-Bigamy Mandates:** Strict monogamy enforcement; married seekers disqualified.
- **UN CEDAW & Anti-Extortion Treaties:** Zero-tolerance automated keyword scanning and one-click in-chat reporting against dowry and commercial asset demands.
- **GDPR Art. 17 & Global Privacy Standards:** Full self-service account deactivation, blurred photo privacy shielding, and permanent biometric KYC data erasure upon account deletion.
- **ePrivacy & DPDP Compliance:** Granular cookie preferences panel with user consent controls.
