<?php

namespace App\Services;

use App\Models\User;
use App\Models\Kundli;

class AstrologyService
{
    // 27 Nakshatras in order
    public const NAKSHATRAS = [
        'Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashira', 'Ardra',
        'Punarvasu', 'Pushya', 'Ashlesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni',
        'Hasta', 'Chitra', 'Swati', 'Vishakha', 'Anuradha', 'Jyeshtha',
        'Mula', 'Purva Ashadha', 'Uttara Ashadha', 'Shravana', 'Dhanishta', 'Shatabhisha',
        'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati'
    ];

    // 12 Rashis in order
    public const RASHIS = [
        'Mesha' => ['lord' => 'Mars', 'element' => 'Fire', 'varna' => 3, 'vashya' => 'Chatushpada'],
        'Vrishabha' => ['lord' => 'Venus', 'element' => 'Earth', 'varna' => 2, 'vashya' => 'Chatushpada'],
        'Mithuna' => ['lord' => 'Mercury', 'element' => 'Air', 'varna' => 1, 'vashya' => 'Manava'],
        'Karka' => ['lord' => 'Moon', 'element' => 'Water', 'varna' => 4, 'vashya' => 'Jalachara'],
        'Simha' => ['lord' => 'Sun', 'element' => 'Fire', 'varna' => 3, 'vashya' => 'Vanachara'],
        'Kanya' => ['lord' => 'Mercury', 'element' => 'Earth', 'varna' => 2, 'vashya' => 'Manava'],
        'Tula' => ['lord' => 'Venus', 'element' => 'Air', 'varna' => 1, 'vashya' => 'Manava'],
        'Vrishchika' => ['lord' => 'Mars', 'element' => 'Water', 'varna' => 4, 'vashya' => 'Keeta'],
        'Dhanu' => ['lord' => 'Jupiter', 'element' => 'Fire', 'varna' => 3, 'vashya' => 'Manava'],
        'Makara' => ['lord' => 'Saturn', 'element' => 'Earth', 'varna' => 2, 'vashya' => 'Jalachara'],
        'Kumbha' => ['lord' => 'Saturn', 'element' => 'Air', 'varna' => 1, 'vashya' => 'Manava'],
        'Meena' => ['lord' => 'Jupiter', 'element' => 'Water', 'varna' => 4, 'vashya' => 'Jalachara'],
    ];

    // Nakshatra Gana (Deva, Manushya, Rakshasa)
    public const NAKSHATRA_GANA = [
        'Ashwini' => 'Deva', 'Bharani' => 'Manushya', 'Krittika' => 'Rakshasa',
        'Rohini' => 'Manushya', 'Mrigashira' => 'Deva', 'Ardra' => 'Manushya',
        'Punarvasu' => 'Deva', 'Pushya' => 'Deva', 'Ashlesha' => 'Rakshasa',
        'Magha' => 'Rakshasa', 'Purva Phalguni' => 'Manushya', 'Uttara Phalguni' => 'Manushya',
        'Hasta' => 'Deva', 'Chitra' => 'Rakshasa', 'Swati' => 'Deva',
        'Vishakha' => 'Rakshasa', 'Anuradha' => 'Deva', 'Jyeshtha' => 'Rakshasa',
        'Mula' => 'Rakshasa', 'Purva Ashadha' => 'Manushya', 'Uttara Ashadha' => 'Manushya',
        'Shravana' => 'Deva', 'Dhanishta' => 'Rakshasa', 'Shatabhisha' => 'Rakshasa',
        'Purva Bhadrapada' => 'Manushya', 'Uttara Bhadrapada' => 'Manushya', 'Revati' => 'Deva'
    ];

    // Nakshatra Nadi (Adi, Madhya, Antya)
    public const NAKSHATRA_NADI = [
        'Ashwini' => 'Adi', 'Bharani' => 'Madhya', 'Krittika' => 'Antya',
        'Rohini' => 'Antya', 'Mrigashira' => 'Madhya', 'Ardra' => 'Adi',
        'Punarvasu' => 'Adi', 'Pushya' => 'Madhya', 'Ashlesha' => 'Antya',
        'Magha' => 'Antya', 'Purva Phalguni' => 'Madhya', 'Uttara Phalguni' => 'Adi',
        'Hasta' => 'Adi', 'Chitra' => 'Madhya', 'Swati' => 'Antya',
        'Vishakha' => 'Antya', 'Anuradha' => 'Madhya', 'Jyeshtha' => 'Adi',
        'Mula' => 'Adi', 'Purva Ashadha' => 'Madhya', 'Uttara Ashadha' => 'Antya',
        'Shravana' => 'Antya', 'Dhanishta' => 'Madhya', 'Shatabhisha' => 'Adi',
        'Purva Bhadrapada' => 'Adi', 'Uttara Bhadrapada' => 'Madhya', 'Revati' => 'Antya'
    ];

    // Nakshatra Yoni Animal
    public const NAKSHATRA_YONI = [
        'Ashwini' => 'Horse', 'Bharani' => 'Elephant', 'Krittika' => 'Sheep',
        'Rohini' => 'Serpent', 'Mrigashira' => 'Serpent', 'Ardra' => 'Dog',
        'Punarvasu' => 'Cat', 'Pushya' => 'Sheep', 'Ashlesha' => 'Cat',
        'Magha' => 'Rat', 'Purva Phalguni' => 'Rat', 'Uttara Phalguni' => 'Cow',
        'Hasta' => 'Buffalo', 'Chitra' => 'Tiger', 'Swati' => 'Buffalo',
        'Vishakha' => 'Tiger', 'Anuradha' => 'Deer', 'Jyeshtha' => 'Deer',
        'Mula' => 'Dog', 'Purva Ashadha' => 'Monkey', 'Uttara Ashadha' => 'Mongoose',
        'Shravana' => 'Monkey', 'Dhanishta' => 'Lion', 'Shatabhisha' => 'Horse',
        'Purva Bhadrapada' => 'Lion', 'Uttara Bhadrapada' => 'Cow', 'Revati' => 'Elephant'
    ];

    /**
     * Compute 36-point Ashtakoota Guna Milan between Groom and Bride.
     */
    public function calculateGunaMilan(Kundli $groomKundli, Kundli $brideKundli): array
    {
        $groomRashi = $groomKundli->rashi ?? 'Mesha';
        $brideRashi = $brideKundli->rashi ?? 'Karka';
        $groomNakshatra = $groomKundli->nakshatra ?? 'Ashwini';
        $brideNakshatra = $brideKundli->nakshatra ?? 'Rohini';

        // 1. Varna (Max 1 pt)
        $groomVarna = self::RASHIS[$groomRashi]['varna'] ?? 2;
        $brideVarna = self::RASHIS[$brideRashi]['varna'] ?? 2;
        $varnaScore = ($groomVarna >= $brideVarna) ? 1.0 : 0.0;

        // 2. Vashya (Max 2 pts)
        $groomVashya = self::RASHIS[$groomRashi]['vashya'] ?? 'Manava';
        $brideVashya = self::RASHIS[$brideRashi]['vashya'] ?? 'Manava';
        $vashyaScore = ($groomVashya === $brideVashya) ? 2.0 : 1.0;

        // 3. Tara (Max 3 pts)
        $groomNakIndex = array_search($groomNakshatra, self::NAKSHATRAS);
        $brideNakIndex = array_search($brideNakshatra, self::NAKSHATRAS);
        if ($groomNakIndex === false) $groomNakIndex = 0;
        if ($brideNakIndex === false) $brideNakIndex = 0;

        $distBrideToGroom = (($groomNakIndex - $brideNakIndex + 27) % 27) % 9;
        $distGroomToBride = (($brideNakIndex - $groomNakIndex + 27) % 27) % 9;
        $inauspiciousTarabala = [2, 4, 6]; // Vipat(3), Pratyak(5), Naidhana(7) in zero-indexed: 2, 4, 6
        $taraScore = 3.0;
        if (in_array($distBrideToGroom, $inauspiciousTarabala) && in_array($distGroomToBride, $inauspiciousTarabala)) {
            $taraScore = 0.0;
        } elseif (in_array($distBrideToGroom, $inauspiciousTarabala) || in_array($distGroomToBride, $inauspiciousTarabala)) {
            $taraScore = 1.5;
        }

        // 4. Yoni (Max 4 pts)
        $groomYoni = self::NAKSHATRA_YONI[$groomNakshatra] ?? 'Horse';
        $brideYoni = self::NAKSHATRA_YONI[$brideNakshatra] ?? 'Elephant';
        $yoniScore = ($groomYoni === $brideYoni) ? 4.0 : 2.5;

        // 5. Graha Maitri (Max 5 pts)
        $groomLord = self::RASHIS[$groomRashi]['lord'] ?? 'Mars';
        $brideLord = self::RASHIS[$brideRashi]['lord'] ?? 'Moon';
        $grahaScore = ($groomLord === $brideLord) ? 5.0 : 3.5;

        // 6. Gana (Max 6 pts)
        $groomGana = self::NAKSHATRA_GANA[$groomNakshatra] ?? 'Deva';
        $brideGana = self::NAKSHATRA_GANA[$brideNakshatra] ?? 'Manushya';
        if ($groomGana === $brideGana) {
            $ganaScore = 6.0;
        } elseif (($groomGana === 'Deva' && $brideGana === 'Manushya') || ($groomGana === 'Manushya' && $brideGana === 'Deva')) {
            $ganaScore = 5.0;
        } else {
            $ganaScore = 1.0; // Gana dosha reduced score
        }

        // 7. Bhakoot (Max 7 pts)
        $rashiKeys = array_keys(self::RASHIS);
        $groomRashiIndex = array_search($groomRashi, $rashiKeys);
        $brideRashiIndex = array_search($brideRashi, $rashiKeys);
        if ($groomRashiIndex === false) $groomRashiIndex = 0;
        if ($brideRashiIndex === false) $brideRashiIndex = 0;

        $rashiDistance = (($brideRashiIndex - $groomRashiIndex + 12) % 12) + 1;
        $doshaDistances = [2, 12, 5, 9, 6, 8];
        $bhakootScore = in_array($rashiDistance, $doshaDistances) ? 0.0 : 7.0;

        // 8. Nadi (Max 8 pts)
        $groomNadi = self::NAKSHATRA_NADI[$groomNakshatra] ?? 'Adi';
        $brideNadi = self::NAKSHATRA_NADI[$brideNakshatra] ?? 'Madhya';
        $nadiScore = ($groomNadi !== $brideNadi) ? 8.0 : 0.0; // Nadi dosha if same

        $totalScore = $varnaScore + $vashyaScore + $taraScore + $yoniScore + $grahaScore + $ganaScore + $bhakootScore + $nadiScore;

        $classification = 'Uttam (Excellent)';
        if ($totalScore < 18) {
            $classification = 'Ashubh (Low Compatibility / Astrological consultation advised)';
        } elseif ($totalScore < 28) {
            $classification = 'Madhyam (Good / Acceptable)';
        }

        return [
            'total_score' => round($totalScore, 1),
            'max_score' => 36,
            'percentage' => round(($totalScore / 36) * 100),
            'classification' => $classification,
            'breakdown' => [
                'varna' => ['score' => $varnaScore, 'max' => 1, 'name' => 'Varna (Spiritual Affinity)'],
                'vashya' => ['score' => $vashyaScore, 'max' => 2, 'name' => 'Vashya (Mutual Attraction)'],
                'tara' => ['score' => $taraScore, 'max' => 3, 'name' => 'Tara (Destiny & Health)'],
                'yoni' => ['score' => $yoniScore, 'max' => 4, 'name' => 'Yoni (Physical Compatibility)'],
                'graha_maitri' => ['score' => $grahaScore, 'max' => 5, 'name' => 'Graha Maitri (Mental Harmony)'],
                'gana' => ['score' => $ganaScore, 'max' => 6, 'name' => 'Gana (Temperament)'],
                'bhakoot' => ['score' => $bhakootScore, 'max' => 7, 'name' => 'Bhakoot (Emotional Harmony)'],
                'nadi' => ['score' => $nadiScore, 'max' => 8, 'name' => 'Nadi (Genetic Compatibility)'],
            ]
        ];
    }

    /**
     * Manglik analysis between two users.
     */
    public function analyzeManglik(Kundli $k1, Kundli $k2): array
    {
        $status1 = $k1->manglik_status ?? 'non_manglik';
        $status2 = $k2->manglik_status ?? 'non_manglik';

        $isM1 = in_array($status1, ['manglik', 'anshik_manglik']);
        $isM2 = in_array($status2, ['manglik', 'anshik_manglik']);

        if (!$isM1 && !$isM2) {
            return [
                'match' => true,
                'label' => 'Both Non-Manglik',
                'severity' => 'success',
                'details' => 'Both candidates are Non-Manglik. Highly compatible astrological alignment.'
            ];
        }

        if ($isM1 && $isM2) {
            return [
                'match' => true,
                'label' => 'Both Manglik (Dosha Cancelled)',
                'severity' => 'success',
                'details' => 'Both candidates have Mangal Dosha, which traditionally cancels the dosha.'
            ];
        }

        return [
            'match' => false,
            'label' => 'Single Manglik Advisory',
            'severity' => 'warning',
            'details' => 'One candidate has Manglik placement while the other does not. Consultation with Pandit or elder recommended.'
        ];
    }

    /**
     * Check Gotra Lineage and same-gotra warning advisory.
     */
    public function checkGotraAdvisory(?string $gotraA, ?string $gotraB, ?string $nanihalA = null, ?string $nanihalB = null): array
    {
        $cleanA = trim(strtolower($gotraA ?? ''));
        $cleanB = trim(strtolower($gotraB ?? ''));

        $isSamePaternal = (!empty($cleanA) && !empty($cleanB) && $cleanA === $cleanB && $cleanA !== 'not known' && $cleanA !== 'kashyapa' && $cleanA !== 'any');
        
        $cleanNanoA = trim(strtolower($nanihalA ?? ''));
        $cleanNanoB = trim(strtolower($nanihalB ?? ''));
        $isSameMaternal = (!empty($cleanNanoA) && !empty($cleanNanoB) && $cleanNanoA === $cleanNanoB);

        if ($isSamePaternal) {
            return [
                'has_advisory' => true,
                'type' => 'paternal_same_gotra',
                'title' => 'Same Gotra Lineage Advisory',
                'message' => "Both candidates share the paternal gotra '{$gotraA}'. In traditional Vedic custom, same-gotra marriage is customarily reviewed by family elders or a community Pandit.",
                'severity' => 'info'
            ];
        }

        if ($isSameMaternal) {
            return [
                'has_advisory' => true,
                'type' => 'maternal_same_gotra',
                'title' => 'Same Nanihal (Maternal) Gotra Advisory',
                'message' => "Both candidates share the maternal gotra '{$nanihalA}'. This is provided as an informational notice for families observing sapinda customs.",
                'severity' => 'info'
            ];
        }

        return [
            'has_advisory' => false,
            'type' => 'clear',
            'title' => 'Different Gotras (Gotra Compatible)',
            'message' => 'Candidates belong to distinct ancestral gotras.',
            'severity' => 'success'
        ];
    }

    /**
     * Compute multi-variable compatibility percentage badge (lifestyle + values + Guna Milan).
     */
    public function calculateOverallCompatibility(User $viewer, User $candidate): array
    {
        $viewerProfile = $viewer->profile;
        $candidateProfile = $candidate->profile;

        $lifestylePoints = 0;
        $maxLifestylePoints = 40;

        // Diet compatibility
        if ($viewerProfile && $candidateProfile) {
            if ($viewerProfile->diet === $candidateProfile->diet) {
                $lifestylePoints += 15;
            } elseif (
                ($viewerProfile->diet === 'vegetarian' && $candidateProfile->diet === 'vegan') ||
                ($viewerProfile->diet === 'vegan' && $candidateProfile->diet === 'vegetarian') ||
                ($viewerProfile->diet === 'eggetarian' && $candidateProfile->diet === 'vegetarian')
            ) {
                $lifestylePoints += 10;
            } else {
                $lifestylePoints += 5;
            }

            // Habits
            if ($viewerProfile->smoking === $candidateProfile->smoking) $lifestylePoints += 5;
            if ($viewerProfile->alcohol === $candidateProfile->alcohol) $lifestylePoints += 5;

            // Family structure & values
            if ($viewerProfile->family_values === $candidateProfile->family_values) $lifestylePoints += 8;
            else $lifestylePoints += 4;

            if ($viewerProfile->family_structure === $candidateProfile->family_structure) $lifestylePoints += 7;
            else $lifestylePoints += 4;
        } else {
            $lifestylePoints = 25;
        }

        // Kundli & Astrology component
        $viewerKundli = $viewer->kundli;
        $candidateKundli = $candidate->kundli;

        $astrologyPoints = 0;
        $maxAstrologyPoints = 60;
        $gunaMilan = null;
        $manglikAnalysis = null;
        $gotraAdvisory = null;

        $gotraAdvisory = $this->checkGotraAdvisory(
            $viewerProfile?->gotra,
            $candidateProfile?->gotra,
            $viewerProfile?->nanihal_gotra,
            $candidateProfile?->nanihal_gotra
        );

        $astrologyBypassed = ($viewerKundli?->horoscope_opt_out || $candidateKundli?->horoscope_opt_out);

        if (!$astrologyBypassed && $viewerKundli && $candidateKundli) {
            $groomKundli = $viewer->gender === 'male' ? $viewerKundli : $candidateKundli;
            $brideKundli = $viewer->gender === 'female' ? $viewerKundli : $candidateKundli;
            $gunaMilan = $this->calculateGunaMilan($groomKundli, $brideKundli);
            $manglikAnalysis = $this->analyzeManglik($viewerKundli, $candidateKundli);

            // Guna Milan is out of 36, scale to 50
            $gunaContribution = ($gunaMilan['total_score'] / 36) * 50;
            $manglikContribution = $manglikAnalysis['match'] ? 10 : 4;
            $astrologyPoints = $gunaContribution + $manglikContribution;
        } else {
            // When astrology is bypassed or not configured, distribute full weight across values & lifestyle
            $maxLifestylePoints = 100;
            $lifestylePoints = ($lifestylePoints / 40) * 100;
            $astrologyPoints = 0;
            $maxAstrologyPoints = 0;
        }

        $totalMax = $maxLifestylePoints + $maxAstrologyPoints;
        $totalEarned = $lifestylePoints + $astrologyPoints;
        $percentage = min(99, max(45, (int) round(($totalEarned / $totalMax) * 100)));

        return [
            'percentage' => $percentage,
            'lifestyle_score' => round($lifestylePoints),
            'guna_milan' => $gunaMilan,
            'manglik_analysis' => $manglikAnalysis,
            'gotra_advisory' => $gotraAdvisory,
            'astrology_bypassed' => $astrologyBypassed,
        ];
    }
}

