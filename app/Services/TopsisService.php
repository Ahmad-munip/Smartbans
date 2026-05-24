<?php

namespace App\Services;

use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\NilaiWarga;
use App\Models\TopsisResult;
use Illuminate\Support\Facades\DB;

class TopsisService
{
    /**
     * Synchronize and parse all warga text values into scores (1-5) saved in nilai_wargas table.
     */
    public function syncNilaiWargas(): void
    {
        $wargas = Warga::all();
        $kriterias = Kriteria::orderBy('kode', 'asc')->get()->keyBy('kode');

        if ($kriterias->count() < 5) {
            return;
        }

        DB::transaction(function () use ($wargas, $kriterias) {
            // Safe clean deletion
            DB::table('nilai_wargas')->delete();

            foreach ($wargas as $w) {
                // C1: Penghasilan Bulanan (Cost)
                $scoreC1 = $this->parsePenghasilan($w->penghasilan);
                NilaiWarga::create([
                    'warga_id' => $w->id,
                    'kriteria_id' => $kriterias['C1']->id,
                    'nilai' => $scoreC1,
                ]);

                // C2: Jumlah Tanggungan (Benefit)
                $scoreC2 = $this->parseTanggungan($w->jumlah_tanggungan);
                NilaiWarga::create([
                    'warga_id' => $w->id,
                    'kriteria_id' => $kriterias['C2']->id,
                    'nilai' => $scoreC2,
                ]);

                // C3: Kondisi Rumah (Benefit)
                $scoreC3 = $this->parseKondisiRumah($w->kondisi_rumah);
                NilaiWarga::create([
                    'warga_id' => $w->id,
                    'kriteria_id' => $kriterias['C3']->id,
                    'nilai' => $scoreC3,
                ]);

                // C4: Status Pekerjaan (Benefit)
                $scoreC4 = $this->parsePekerjaan($w->pekerjaan);
                NilaiWarga::create([
                    'warga_id' => $w->id,
                    'kriteria_id' => $kriterias['C4']->id,
                    'nilai' => $scoreC4,
                ]);

                // C5: Kepemilikan Aset (Cost)
                $scoreC5 = $this->parseAset($w->kepemilikan_aset);
                NilaiWarga::create([
                    'warga_id' => $w->id,
                    'kriteria_id' => $kriterias['C5']->id,
                    'nilai' => $scoreC5,
                ]);
            }
        });
    }

    /**
     * Run full TOPSIS mathematical pipeline and store the results.
     */
    public function calculateTOPSIS(int $quota = 5): array
    {
        // 1. Sync nilai wargas first to ensure current master data scores are saved
        $this->syncNilaiWargas();

        $wargas = Warga::all();
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $n = $kriterias->count(); // criteria count
        $m = $wargas->count();    // alternatives count

        if ($m === 0 || $n === 0) {
            return [
                'alternatives' => [],
                'decision_matrix' => [],
                'normalized_matrix' => [],
                'weighted_normalized_matrix' => [],
                'ideal_positive' => [],
                'ideal_negative' => [],
                'distances' => [],
                'preferences' => [],
                'quota' => $quota,
            ];
        }

        // 2. Fetch AHP weights or fallback to default ones if empty
        $weights = [];
        foreach ($kriterias as $k) {
            $weights[$k->id] = (double)($k->bobot ?: (1.0 / $n));
        }

        // 3. Build Decision Matrix (X)
        $decisionMatrix = [];
        $wargaScores = NilaiWarga::all()->groupBy('warga_id');

        foreach ($wargas as $w) {
            $scores = $wargaScores->get($w->id);
            foreach ($kriterias as $k) {
                $matchingScore = $scores ? $scores->firstWhere('kriteria_id', $k->id) : null;
                $val = $matchingScore ? $matchingScore->nilai : 3; // Fallback neutral value
                $decisionMatrix[$w->id][$k->id] = (double)$val;
            }
        }

        // 4. Calculate Vector Lengths for columns (divisors for Normalization)
        $colLengths = [];
        foreach ($kriterias as $k) {
            $sumSq = 0.0;
            foreach ($wargas as $w) {
                $val = $decisionMatrix[$w->id][$k->id];
                $sumSq += ($val * $val);
            }
            $colLengths[$k->id] = sqrt($sumSq) ?: 1.0; // Avoid division by zero
        }

        // 5. Normalized Decision Matrix (R)
        $normalizedMatrix = [];
        foreach ($wargas as $w) {
            foreach ($kriterias as $k) {
                $normalizedMatrix[$w->id][$k->id] = $decisionMatrix[$w->id][$k->id] / $colLengths[$k->id];
            }
        }

        // 6. Weighted Normalized Decision Matrix (Y)
        $weightedNormalizedMatrix = [];
        foreach ($wargas as $w) {
            foreach ($kriterias as $k) {
                $weightedNormalizedMatrix[$w->id][$k->id] = $normalizedMatrix[$w->id][$k->id] * $weights[$k->id];
            }
        }

        // 7. Determine Solusi Ideal Positif (A+) & Negatif (A-)
        $idealPositive = [];
        $idealNegative = [];

        foreach ($kriterias as $k) {
            $vals = [];
            foreach ($wargas as $w) {
                $vals[] = $weightedNormalizedMatrix[$w->id][$k->id];
            }

            $isBenefit = strtolower($k->jenis) === 'benefit';

            if ($isBenefit) {
                $idealPositive[$k->id] = max($vals);
                $idealNegative[$k->id] = min($vals);
            } else {
                // Cost: A+ is min, A- is max
                $idealPositive[$k->id] = min($vals);
                $idealNegative[$k->id] = max($vals);
            }
        }

        // 8. Calculate Distances (D+ and D-) and Preference score (V)
        $distances = [];
        $preferences = [];

        foreach ($wargas as $w) {
            $sumSqPlus = 0.0;
            $sumSqMinus = 0.0;

            foreach ($kriterias as $k) {
                $yVal = $weightedNormalizedMatrix[$w->id][$k->id];
                
                $diffPlus = $yVal - $idealPositive[$k->id];
                $sumSqPlus += ($diffPlus * $diffPlus);

                $diffMinus = $yVal - $idealNegative[$k->id];
                $sumSqMinus += ($diffMinus * $diffMinus);
            }

            $dPlus = sqrt($sumSqPlus);
            $dMinus = sqrt($sumSqMinus);
            $v = ($dPlus + $dMinus) > 0 ? ($dMinus / ($dPlus + $dMinus)) : 0.0;

            $distances[$w->id] = [
                'd_plus' => $dPlus,
                'd_minus' => $dMinus,
            ];
            $preferences[$w->id] = $v;
        }

        // 9. Rank alternatives descending by Preference Score
        arsort($preferences);

        $rankedAlternatives = [];
        $rankCounter = 1;

        foreach ($preferences as $wId => $v) {
            $w = $wargas->find($wId);
            $status = $rankCounter <= $quota ? 'layak' : 'tidak_layak';

            $rankedAlternatives[$wId] = [
                'warga' => $w,
                'v' => $v,
                'd_plus' => $distances[$wId]['d_plus'],
                'd_minus' => $distances[$wId]['d_minus'],
                'ranking' => $rankCounter,
                'status' => $status,
            ];

            $rankCounter++;
        }

        // 10. Store everything inside topsis_results table in database
        DB::transaction(function () use ($rankedAlternatives) {
            DB::table('topsis_results')->delete();

            foreach ($rankedAlternatives as $wId => $res) {
                TopsisResult::create([
                    'warga_id' => $wId,
                    'nilai_d_plus' => $res['d_plus'],
                    'nilai_d_minus' => $res['d_minus'],
                    'nilai_preferensi' => $res['v'],
                    'ranking' => $res['ranking'],
                    'status' => $res['status'],
                ]);
            }
        });

        return [
            'alternatives' => $rankedAlternatives,
            'decision_matrix' => $decisionMatrix,
            'normalized_matrix' => $normalizedMatrix,
            'weighted_normalized_matrix' => $weightedNormalizedMatrix,
            'ideal_positive' => $idealPositive,
            'ideal_negative' => $idealNegative,
            'distances' => $distances,
            'preferences' => $preferences,
            'quota' => $quota,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Resilient String Parsing Sub-helpers
    |--------------------------------------------------------------------------
    */

    private function parsePenghasilan($val): int
    {
        $num = (double)$val;
        if ($num < 1000000) return 5;
        if ($num <= 2000000) return 4;
        if ($num <= 3000000) return 3;
        if ($num <= 5000000) return 2;
        return 1;
    }

    private function parseTanggungan($val): int
    {
        $num = (int)$val;
        if ($num >= 5) return 5;
        if ($num == 4) return 4;
        if ($num == 3) return 3;
        if ($num == 2) return 2;
        return 1;
    }

    private function parseKondisiRumah(string $text): int
    {
        if (stripos($text, 'Sangat Buruk') !== false) return 5;
        if (stripos($text, 'Buruk') !== false) return 4;
        if (stripos($text, 'Cukup') !== false) return 3;
        if (stripos($text, 'Sangat Baik') !== false) return 1;
        if (stripos($text, 'Baik') !== false) return 2;
        return 3; // Neutral
    }

    private function parsePekerjaan(string $text): int
    {
        if (stripos($text, 'Tidak Bekerja') !== false || stripos($text, 'Pengangguran') !== false) return 5;
        if (stripos($text, 'Buruh Harian') !== false) return 4;
        if (stripos($text, 'Petani') !== false || stripos($text, 'Nelayan') !== false) return 3;
        if (stripos($text, 'Swasta Tidak Tetap') !== false || stripos($text, 'Mikro') !== false) return 2;
        if (stripos($text, 'PNS') !== false || stripos($text, 'BUMN') !== false || stripos($text, 'Tetap') !== false) return 1;
        return 2; // Default moderate
    }

    private function parseAset(string $text): int
    {
        if (stripos($text, 'Tidak Memiliki Aset') !== false) return 5;
        if (stripos($text, 'Aset Kecil') !== false || stripos($text, 'sepeda') !== false) return 4;
        if (stripos($text, 'Motor') !== false) return 3;
        if (stripos($text, 'Mobil') !== false || stripos($text, 'Tanah') !== false) return 2;
        if (stripos($text, 'Mewah') !== false) return 1;
        return 3; // Default moderate
    }
}
