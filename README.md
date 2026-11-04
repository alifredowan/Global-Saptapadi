# Vivah Connect (পবিত্র বিবাহ মিলন)
### Specialized Hindu Matrimonial Platform
**Engineered with Laravel 13, Node.js Real-Time Socket Gateway, and PostgreSQL 16**

*Reference Basis: User Requirements Specification (URS v1.0) & Nikah Connect Architectural Heritage adapted for Dharmic Traditions.*

---

## ॐ Architectural Overview

Vivah Connect is an enterprise-grade matrimonial web platform engineered exclusively for serious, marriage-oriented Hindus, Jains, Sikhs, and Buddhists. It prioritizes familial dignity, cultural compatibility, verified identity, statutory civil laws, and customary Vedic safeguards.

```
+---------------------------------------------------------------------------------------+
|                                    VIVAH CONNECT                                      |
+---------------------------------------------------------------------------------------+
|  FRONTEND & WEB PORTAL (Tailwind CSS, Auspicious Aesthetics, Multilingual EN/BN/HI)   |
+-------------------------------------------+-------------------------------------------+
|               LARAVEL 13                  |           NODE.JS REAL-TIME GATEWAY       |
|       (PHP 8.4 REST & Controller Engine)  |         (Express + Socket.IO Server)      |
+-------------------------------------------+-------------------------------------------+
| - Statutory Age Verification (21 M/18 F)  | - Sub-second Real-time Peer Messaging     |
| - 36-Point Ashtakoota Guna Milan Engine   | - Real-time Regex Contact Shielding       |
| - Same-Gotra & Nanihal Warning Advisories | - Real-time Anti-Dowry Interception       |
| - 3-Tier Photo Privacy & Server-side Blur | - Real-time Family Chaperone Broadcasting |
| - Family Representative Delegation System | - Active User Presence Tracking           |
| - Shubho Bibaho Certificate Generator     |                                           |
| - KYC Identity Verification & Trust Badge |                                           |
| - Pro Single Vivah Pass (One-time fee)    |                                           |
+-------------------------------------------+-------------------------------------------+
|                               POSTGRESQL 16 DATABASE                                  |
|     (Profiles, Kundlis, Preferences, Proposals, Messages, KYC, Milestones, Audit)     |
+---------------------------------------------------------------------------------------+
```

---

## 📋 Comprehensive Feature Map (URS Implementation)

### 1. Registration & Account Setup (URS Section 4.1)
- **Statutory Legal Age Enforcement (FR-1.2):** Validates minimum **21 years for males** and **18 years for females** under the Hindu Marriage Act. Underage registrations are blocked at the engine level.
- **Strict Monogamy Mandate (FR-1.1):** Polygamy is barred; married candidates are strictly disqualified. Comprehensive support for **Never Married, Divorced, Widowed, and Annulled** seekers without discrimination.
- **"Profile Managed By" Attribution (FR-1.4):** Transparent metadata tracking whether a profile is candidate-managed or elder-managed (Father, Mother, Brother, Sister, Uncle, Aunt, Grandparent, Other).
- **Dual-Channel Verification (FR-1.3):** Email and SMS verification simulation.
- **Multilingual Localization (FR-1.5):** User interface localized for English, Bengali (বাংলা), and Hindi (हिन्दी).

### 2. Biodata & Cultural Lineage Architecture (URS Section 4.2)
- **Physical & Personal Data (FR-2.1):** Height, weight, complexion, mother tongue, citizenship, and residential location.
- **Dharmic Communities & Lineage (FR-2.3, FR-2.4):** 
  - Religion (Hindu, Jain, Sikh, Buddhist)
  - Sampradaya (Vaishnav, Shaiva, Shakta, Smarta, ISKCON, Arya Samaj)
  - Caste/Jati and Regional Sub-caste (e.g. Rarhi, Barendra, Kulin) with prominent **"Caste No Bar"** option.
  - Paternal Gotra and Maternal Lineage (Nanihal Gotra).
- **Lifestyle & Customary Practice (FR-2.5, FR-2.6):**
  - Dietary Practice (Vegetarian, Eggetarian, Non-vegetarian, Jain, Vegan)
  - Devotional Routine: Daily Puja frequency, Temple visits, Fasting (Vrata) observance, Scripture study (Gita, Vedas, Ramayana), and Guru lineage.
- **Family Background (FR-2.7):** Structure (Joint / Nuclear), family values (traditional, moderate, liberal), parent occupations, and post-marriage living arrangement preferences.
- **Dynamic Profile Completeness Score (FR-2.9):** 0–100% algorithm weighting discovery visibility.

### 3. Janam Patrika & 36-Point Ashtakoota Guna Milan (URS Section 4.3)
- **Automated Guna Milan Engine (FR-3.3):** Full Vedic astrological matching across all 8 Kootas (Total 36 points):
  1. *Varna (1 pt)*: Spiritual affinity and work temperaments.
  2. *Vashya (2 pts)*: Mutual attraction and psychological dominance.
  3. *Tara (3 pts)*: Health, destiny, and longevity from Nakshatra distance.
  4. *Yoni (4 pts)*: Biological and physical affinity (14 animal classes).
  5. *Graha Maitri (5 pts)*: Planetary Moon-sign Lord friendship and mental harmony.
  6. *Gana (6 pts)*: Temperament matching (Deva, Manushya, Rakshasa).
  7. *Bhakoot (7 pts)*: Emotional harmony, financial prosperity, and dosha checking.
  8. *Nadi (8 pts)*: Genetic, physiological compatibility (Adi, Madhya, Antya).
- **Manglik Placement Analysis (FR-3.4):** Evaluates Mangal Dosha with automated cancellation analysis when both candidates share Manglik placement.
- **Astrology Opt-Out Toggle (FR-3.5):** Users may select *"Horoscope Not Required"* to evaluate solely based on shared values and lifestyle.
- **Same-Gotra Advisory (FR-3.6):** Automated non-blocking informational notice when candidates share paternal or maternal gotras.
- **Permission-Gated Chart Upload (FR-3.2):** Secure upload of physical Kundli charts (PDF/image).

### 4. Photo Privacy & Media Shield (URS Section 4.4)
- **Three-Tier Privacy Controls (FR-4.2):**
  - *Fully Public*: Visible to all authenticated seekers.
  - *Blurred Until Mutual*: Automatic server-side Gaussian blur; unblurred photo revealed only upon mutual proposal acceptance. Default for female seekers.
  - *Restricted*: Accessible only through explicit user grant.
- **Server-Side Blur Processing (FR-4.1):** Dual-image generation protecting against raw asset leakage.

### 5. Family Representative Delegation System (URS Section 4.5)
- **Universal Representation (FR-5.3):** Fathers, mothers, siblings, or elders can act as verified representatives for both grooms and brides.
- **Granular Permission Scopes (FR-5.2):** *Approval Required*, *Read-Only Oversight*, or *Full Proxy Management*.
- **Dedicated Family Dashboard (FR-5.4):** Displays assigned wards, pending inbound proposals, chaperoned chat monitoring, and polite response macros.
- **Self-Managed Independent Mode (FR-5.5):** For candidates registering without family involvement.
- **Perpetually Free Access (FR-5.6):** Family representative accounts are forever 100% free.

### 6. Discovery, Matching & Search (URS Section 4.6)
- **Strict Heterosexual Opposite-Gender Indexing (FR-6.1):** Grooms see Brides only; Brides see Grooms only. Active married users automatically excluded from index.
- **Basic & Advanced Filters (FR-6.2, FR-6.3):** Age, city, marital status, diet, Gotra exclusion, Sampradaya, Manglik status, and minimum Guna Milan score.
- **Multi-Variable Compatibility Badge (FR-6.4):** Displays composite percentage combining lifestyle, values, and astrological points.
- **Private Shortlist Repository (FR-6.7):** Pro tier feature with confidential candidate notes.

### 7. Proposal & Interest Workflow (URS Section 4.7)
- **Dignified Matrimonial Interests (FR-7.1):** Pre-formatted respectful introductory notes.
- **Automated Routing to Family Elders (FR-7.2):** Where "Approval Required" mode is active, proposals route to family representatives first.
- **Accept/Decline Response Actions (FR-7.3):** Unlocks encrypted chaperoned chat and mutual photo reveal.
- **Tiered Daily Activity Throttling (FR-7.4):** Free Explorer capped at 5 interests/day and 10 views/day; Pro Single Vivah Pass unlimited.

### 8. Secure Chaperoned Communication (URS Section 4.8)
- **Real-Time Sub-Second Peer Messaging (FR-8.1, NFR-5):** Powered by the Node.js Socket.IO server.
- **Contact Shielding (FR-8.2):** Real-time regex masking of telephone numbers, email addresses, and social media handles.
- **Anti-Dowry Detection Engine (FR-8.4):** Scans for and immediately blocks messages containing dowry or transactional asset solicitations (Dowry Prohibition Act).
- **Visible Family Oversight Banner (FR-8.5):** Transparent notice that the dialogue is chaperoned.
- **Formal Contact Exchange Channel (FR-8.6):** Two-way mutual consent buttons unlocking verified telephone numbers and emails.

### 9. Safety, KYC Verification & Moderation (URS Section 4.9)
- **Mandatory Government ID & Live Selfie Audit (FR-9.1):** Admin review within 24–48 hours.
- **"Verified Seeker" Crest Badge (FR-9.2):** Displayed on authenticated biodatas.
- **Silent Mutual Blocking (FR-9.3):** Complete reciprocal invisibility between blocked users.
- **Immutable Server Audit Logs (NFR-4):** Records all administrative and matrimonial actions.

### 10. Monetisation & The Single Vivah Pass (URS Section 4.10)
- **Bifurcated Model (FR-10.1):** Free Explorer vs Pro "Single Vivah Pass" (one-time fee valid until marriage confirmation).
- **Regional Payment Integrations (FR-10.3):** Supports bKash, Nagad, UPI, Card, and promotional voucher code redemption (`SHUBHOVIVAH`).

### 11. Vivah Milestone & Shubho Bibaho Certificate (URS Section 4.11)
- **Marriage Declaration Workflow (FR-11.1):** Candidate selects spouse and enters solemnization date.
- **Commemorative "Shubho Bibaho" Digital Certificate (FR-11.2):** High-resolution printable certificate with unique registry UUID, gotras, wedding date, and Sanskrit shlokas.
- **Automated Lifecycle De-Indexing (FR-11.3):** Updates status to Married, closes outstanding proposals, revokes photo permissions, and locks chat to read-only.
- **Voluntary Success Story Showcase (FR-11.4):** Portal for community wedding stories.

---

## 🚀 Quick Start Guide

### 1. Prerequisites
- **PHP 8.2+** with extensions: `pdo_pgsql`, `pgsql`, `gd`, `intl`, `openssl`, `mbstring`.
- **Node.js 20+** and `npm`.
- **PostgreSQL 16+** running on `127.0.0.1:5432` with database `vivah_connect`.

### 2. Configuration (`.env`)
The database and Node socket configurations are pre-configured:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=vivah_connect
DB_USERNAME=postgres
DB_PASSWORD=postgres

NODE_SOCKET_PORT=3000
NODE_SOCKET_URL=http://localhost:3000
```

### 3. Database Migration & Demo Data Seeding
Run migrations and populate the database with comprehensive Hindu Matrimony demo profiles:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 4. Running the Application

Open two terminal sessions:

**Terminal 1 (Laravel Web Server):**
```bash
php artisan serve
```
*Accessible at: `http://127.0.0.1:8000`*

**Terminal 2 (Node.js Real-Time Socket Service):**
```bash
npm run realtime
```
*WebSocket service listening on port `3000`*

---

## 👥 Seeded Evaluation Demo Accounts

You can test any role instantly using the demo credentials below or by clicking the **Quick Role Switcher** at the top of the webpage:

| Role | Email | Password | Notable Features & Scenarios |
| :--- | :--- | :--- | :--- |
| **Groom (Seeker)** | `arun@example.com` | `password123` | Dr. Arun Banerjee • 30 yrs • MD Physician • Shandilya Gotra • Pro Single Vivah Pass • Verified Seeker |
| **Groom (Seeker)** | `rohit@example.com` | `password123` | Rohit Chatterjee • 28 yrs • Software Engineer • Kashyapa Gotra • Free Explorer |
| **Bride (Seeker)** | `priya@example.com` | `password123` | Priya Mukherjee • 25 yrs • Lecturer • Shandilya Gotra (tests same-gotra advisory with Arun!) • Modesty photo blur • Father managed |
| **Bride (Seeker)** | `ananya@example.com` | `password123` | Ananya Roy • 26 yrs • Investment Banker • Has accepted mutual chat with Rohit |
| **Bride (Remarriage)**| `pooja@example.com` | `password123` | Dr. Pooja Das • 31 yrs • Divorced Remarriage dignity • ISKCON • Dental Surgeon |
| **Family Representative**| `subhash@example.com` | `password123` | Subhash Chandra Mukherjee • Priya's Father • "Approval Required" Elder Dashboard |
| **Admin & Trust Officer**| `admin@vivahconnect.com`| `password123`| Operations Dashboard, KYC Review Queue, Anti-Dowry Reports & Immutable Audit Logs |

---

## 🧪 Automated Test Suite

Run the full PHPUnit test suite validating statutory age, monogamy, Ashtakoota Guna Milan, same-gotra detection, contact shielding, anti-dowry filters, and automated de-indexing:
```bash
php artisan test
```
*14 tests passed (57 assertions, 0 failures).*

---

## ⚖️ Legal & Ethical Compliance
- **Hindu Marriage Act 1955 & Bangladesh Legal Codes:** Statutory age limits (21 M / 18 F) strictly enforced; bigamy barred.
- **Dowry Prohibition Act 1961 (India) & 2018 (Bangladesh):** Zero-tolerance automated keyword scanning and one-click in-chat reporting.
- **DPDP Act 2023 & GDPR:** Self-service account deactivation and permanent data erasure.
