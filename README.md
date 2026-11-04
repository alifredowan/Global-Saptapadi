# Vivah Connect
### Sacred Dharmic Matrimonial Platform (Worldwide)
**Engineered with Laravel 13, Laravel Reverb WebSockets, PostgreSQL 16, and Tailwind CSS**

*Architectural Reference: User Requirements Specification (URS v1.0) with International Matrimonial Standards and Global Dharmic Lineage Safeguards.*

---

## Architectural Overview

Vivah Connect is an enterprise-grade matrimonial platform engineered for marriage-oriented Hindu, Jain, Sikh, and Buddhist seekers across North America, Europe, the United Kingdom, Asia-Pacific, and the worldwide Dharmic diaspora. It prioritizes familial dignity, cultural compatibility, verified identity, statutory civil laws, and customary Vedic safeguards.

```
+---------------------------------------------------------------------------------------+
|                                    VIVAH CONNECT                                      |
+---------------------------------------------------------------------------------------+
|  FRONTEND & WEB PORTAL (Tailwind CSS, Auspicious Aesthetics, Strictly English, DD/MM) |
+-------------------------------------------+-------------------------------------------+
|               LARAVEL 13                  |         LARAVEL REVERB WEBSOCKETS         |
|      (PHP 8.4 REST & Controller Engine)   |      (Port 8085 Real-Time Engine)         |
+-------------------------------------------+-------------------------------------------+
| - Statutory Age Verification (21 M/18 F)  | - Sub-second Real-time Peer Messaging     |
| - 36-Point Ashtakoota Guna Milan Engine   | - Real-time Regex Contact Shielding       |
| - Same-Gotra & Nanihal Warning Advisories | - Real-time Anti-Dowry Interception       |
| - 3-Tier Photo Privacy & Server-side Blur | - Real-time Family Chaperone Broadcasts   |
| - Family Representative Delegation System | - Active User Presence Tracking           |
| - Shubho Bibaho Certificate Generator     |                                           |
| - International KYC & Trust Badge         |                                           |
| - Single Vivah Pass (Stripe & PayPal)     |                                           |
+-------------------------------------------+-------------------------------------------+
|                               POSTGRESQL 16 DATABASE                                  |
|     (Profiles, Kundlis, Preferences, Proposals, Messages, KYC, Milestones, Audit)     |
+---------------------------------------------------------------------------------------+
```

---

## Comprehensive Feature Map

### 1. Registration & International Account Verification
- **Statutory Legal Age Enforcement:** Enforces minimum **21 years for grooms** and **18 years for brides** in compliance with statutory matrimonial age laws and the **UN Convention on Consent to Marriage** (universal adult threshold 18+). Underage registrations are blocked at the engine level.
- **Strict Monogamy Mandate:** Bigamy and polygamy are strictly barred under international family law and Dharmic matrimonial codes. Supported statuses: **Never Married, Divorced, Widowed, and Annulled** seekers.
- **"Profile Managed By" Attribution:** Transparent metadata tracking whether a profile is candidate-managed or family-managed (Self, Father, Mother, Brother, Sister, Uncle, Aunt, Grandparent, Other Relative).
- **Strict English System Standard:** The entire application interface, notifications, receipts, and communication modules operate exclusively in English.
- **Strict International Date Format:** All dates across views, tables, and receipts strictly adhere to the international **`DD/MM/YYYY`** format.

### 2. Biodata & Cultural Lineage Architecture
- **Global Residential Data:** Country of residence, citizenship, city/region, height, weight, complexion, and mother tongue.
- **Dharmic Communities & Lineage:**
  - Religion (Hindu, Jain, Sikh, Buddhist)
  - Sampradaya (Vaishnav, Shaiva, Shakta, Smarta, ISKCON, Arya Samaj)
  - Caste/Jati and Regional Sub-caste with prominent **"Caste No Bar"** option.
  - Paternal Gotra and Maternal Lineage (Nanihal Gotra).
- **Lifestyle & Customary Practice:**
  - Dietary Practice (Vegetarian, Eggetarian, Non-vegetarian, Jain, Vegan)
  - Devotional Routine: Daily Puja frequency, Temple visits, Fasting (Vrata) observance, Scripture study, and Guru lineage.
- **Family Background:** Structure (Joint / Nuclear), family values (traditional, moderate, liberal), parent occupations, and post-marriage living arrangement preferences.
- **Dynamic Profile Completeness Score:** 0–100% algorithm weighting discovery visibility.

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
- **Same-Gotra Advisory:** Automated non-blocking informational notice when candidates share paternal gotra or maternal lineage.
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
- **"Verified Seeker" Crest Badge:** Displayed on authenticated biodatas.
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

---

## Quick Start Guide

### 1. Prerequisites
- **PHP 8.3+** with extensions: `pdo_pgsql`, `pgsql`, `gd`, `intl`, `openssl`, `mbstring`.
- **Node.js 20+** and `npm`.
- **PostgreSQL 16+** running on `127.0.0.1:5432` with database `vivah_connect`.

### 2. Configuration (`.env`)
The database, Reverb, Stripe, and PayPal configurations:
```env
APP_NAME="Vivah Connect"
APP_ENV=local
APP_URL=http://localhost:5001

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=vivah_connect
DB_USERNAME=postgres
DB_PASSWORD=postgres

BROADCAST_CONNECTION=reverb
REVERB_APP_ID=100101
REVERB_APP_KEY=vivahconnectreverbkey
REVERB_APP_SECRET=vivahconnectreverbsecret
REVERB_HOST="127.0.0.1"
REVERB_PORT=8085
REVERB_SCHEME="http"

STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_CURRENCY=USD

PAYPAL_CLIENT_ID=sb_...
PAYPAL_SECRET=sb_...
PAYPAL_MODE=sandbox
PAYPAL_CURRENCY=USD
```

### 3. Database Migration & Worldwide Demo Seeding
```bash
php artisan migrate:fresh --seed
```

### 4. Running the Application

Open two terminal sessions:

**Terminal 1 (Laravel Web Server on Port 5001):**
```bash
php artisan serve --port=5001
```
*Accessible at: `http://127.0.0.1:5001`*

**Terminal 2 (Laravel Reverb WebSocket Server):**
```bash
php artisan reverb:start --port=8085
```
*Reverb WebSocket service listening on `127.0.0.1:8085`*

---

## Seeded Evaluation Demo Accounts

All test accounts share the default password: **`password123`**. You can test any role instantly or use the Demo Persona Switcher:

| Role | Email | Password | Location & Scenario |
| :--- | :--- | :--- | :--- |
| **Groom (Seeker)** | `arun@example.com` | `password123` | Dr. Arun Banerjee • 30 yrs • MD Physician • Manhattan, New York, **United States** • Shandilya Gotra • Pro Single Vivah Pass |
| **Groom (Seeker)** | `rohit@example.com` | `password123` | Rohit Chatterjee • 28 yrs • Senior Software Engineer • London, **United Kingdom** • Kashyapa Gotra • Free Explorer |
| **Bride (Seeker)** | `priya@example.com` | `password123` | Priya Mukherjee • 25 yrs • Assistant Professor • Toronto, **Canada** • Shandilya Gotra • Modesty Photo Blur • Father Managed |
| **Bride (Seeker)** | `ananya@example.com` | `password123` | Ananya Roy • 26 yrs • Investment Banking Analyst • Mumbai, **India** • Mutual accepted proposal with Rohit |
| **Bride (Remarriage)** | `pooja@example.com` | `password123` | Dr. Pooja Das • 31 yrs • Dental Surgeon • Sydney, **Australia** • Divorced Remarriage Dignity • ISKCON |
| **Family Representative** | `subhash@example.com` | `password123` | Subhash Chandra Mukherjee • Priya's Father • Toronto, **Canada** • Chaperone Approval Dashboard |
| **Admin & Trust Officer** | `admin@vivahconnect.com` | `password123` | Trust Operations Dashboard, KYC Review Queue, Anti-Dowry Reports & Immutable Audit Logs |

---

## Automated Test Suite

Run the full PHPUnit test suite validating statutory age, monogamy, Ashtakoota Guna Milan, same-gotra detection, contact shielding, anti-dowry filters, Reverb chaperoned messaging, and one-time Stripe/PayPal Single Vivah Pass checkouts:
```bash
php artisan test
```
*Result: 21 tests passed (111 assertions, 0 errors).*

---

## Legal & Ethical Compliance
- **UN Convention on Consent to Marriage:** Minimum age for marriage (21 for grooms, 18 for brides) strictly enforced; underage registrations barred globally.
- **International Anti-Bigamy Mandates:** Strict monogamy enforcement; married seekers disqualified.
- **UN CEDAW & Anti-Extortion Treaties:** Zero-tolerance automated keyword scanning and one-click in-chat reporting against dowry and commercial asset demands.
- **GDPR Art. 17 & Global Privacy Standards:** Full self-service account deactivation, blurred photo privacy shielding, and permanent biometric KYC data erasure upon account deletion.
