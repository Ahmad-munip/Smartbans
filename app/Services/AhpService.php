<?php

namespace App\Services;

use App\Models\Kriteria;
use App\Models\AhpComparison;
use App\Models\AhpResult;
use Illuminate\Support\Facades\DB;

class AhpService
{
    // Random Index (RI) table for AHP consistency calculations
    private array $randomIndex = [
        1  => 0.00,
        2  => 0.00,
        3  => 0.58,
        4  => 0.90,
        5  => 1.12,
        6  => 1.24,
        7  => 1.32,
        8  => 1.41,
        9  => 1.45,
        10 => 1.49,
    ];

    /**
     * Get the pairwise comparison matrix from database.
     * Defaults to an identity matrix (all values 1.0) if none exists.
     */
    public function getMatrix(): array
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $n = $kriterias->count();
        $matrix = [];

        // Pre-fill identity matrix
        foreach ($kriterias as $k1) {
            foreach ($kriterias as $k2) {
                if ($k1->id == $k2->id) {
                    $matrix[$k1->id][$k2->id] = 1.0;
                } else {
                    $matrix[$k1->id][$k2->id] = 1.0; // Default equal importance
                }
            }
        }

        // Load existing evaluations from database
        $comparisons = AhpComparison::all();
        foreach ($comparisons as $comp) {
            if (isset($matrix[$comp->kriteria_pertama_id][$comp->kriteria_kedua_id])) {
                $matrix[$comp->kriteria_pertama_id][$comp->kriteria_kedua_id] = (double)$comp->nilai;
            }
        }

        return $matrix;
    }

    /**
     * Compute AHP priority vector, lambda max, consistency index, and consistency ratio.
     */
    public function calculateAHP(array $matrix): array
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $n = $kriterias->count();
        
        if ($n === 0) {
            return [
                'weights' => [],
                'lambda_max' => 0.0,
                'ci' => 0.0,
                'cr' => 0.0,
                'is_consistent' => true,
            ];
        }

        // 1. Calculate column sums
        $colSums = [];
        foreach ($kriterias as $kCol) {
            $sum = 0.0;
            foreach ($kriterias as $kRow) {
                $sum += $matrix[$kRow->id][$kCol->id];
            }
            $colSums[$kCol->id] = $sum;
        }

        // 2. Normalize matrix & compute priority weights (average of normalized rows)
        $normMatrix = [];
        $weights = [];
        foreach ($kriterias as $kRow) {
            $rowSum = 0.0;
            foreach ($kriterias as $kCol) {
                // Avoid division by zero
                $colSum = $colSums[$kCol->id] ?: 1.0;
                $val = $matrix[$kRow->id][$kCol->id] / $colSum;
                $normMatrix[$kRow->id][$kCol->id] = $val;
                $rowSum += $val;
            }
            $weights[$kRow->id] = $rowSum / $n;
        }

        // 3. Compute consistency vector
        // Original Matrix multiplied by Weight vector
        $consistencyVector = [];
        foreach ($kriterias as $kRow) {
            $sum = 0.0;
            foreach ($kriterias as $kCol) {
                $sum += $matrix[$kRow->id][$kCol->id] * $weights[$kCol->id];
            }
            // Divide elements by corresponding weight to get consistency ratios
            $rowWeight = $weights[$kRow->id] ?: 1.0;
            $consistencyVector[$kRow->id] = $sum / $rowWeight;
        }

        // 4. Calculate Lambda Max (average of consistency ratios)
        $lambdaMax = count($consistencyVector) > 0 ? array_sum($consistencyVector) / count($consistencyVector) : 0.0;

        // 5. Calculate Consistency Index (CI)
        $ci = $n > 1 ? ($lambdaMax - $n) / ($n - 1) : 0.0;

        // 6. Calculate Consistency Ratio (CR)
        $ri = $this->randomIndex[$n] ?? 1.49;
        $cr = $ri > 0 ? $ci / $ri : 0.0;

        // 7. Check if CR is consistent (Threshold: <= 0.1)
        $isConsistent = $cr <= 0.1;

        return [
            'weights' => $weights,
            'lambda_max' => $lambdaMax,
            'ci' => $ci,
            'cr' => $cr,
            'is_consistent' => $isConsistent,
        ];
    }

    /**
     * Save the matrix evaluations to DB and run AHP equations.
     * Caches outputs inside `ahp_results` and updates `kriterias` table if matrix is consistent.
     */
    public function saveMatrix(array $matrixData): array
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $n = $kriterias->count();

        // 1. Build and clean full matrix including reciprocal values
        $fullMatrix = [];
        foreach ($kriterias as $k1) {
            foreach ($kriterias as $k2) {
                if ($k1->id == $k2->id) {
                    $fullMatrix[$k1->id][$k2->id] = 1.0;
                } else {
                    // Check if value is provided, otherwise inverse
                    if (isset($matrixData[$k1->id][$k2->id])) {
                        $val = (double)$matrixData[$k1->id][$k2->id];
                        $fullMatrix[$k1->id][$k2->id] = $val;
                    } elseif (isset($matrixData[$k2->id][$k1->id]) && (double)$matrixData[$k2->id][$k1->id] != 0) {
                        $val = 1.0 / (double)$matrixData[$k2->id][$k1->id];
                        $fullMatrix[$k1->id][$k2->id] = $val;
                    } else {
                        $fullMatrix[$k1->id][$k2->id] = 1.0;
                    }
                }
            }
        }

        // 2. Perform DB operations inside transaction
        return DB::transaction(function () use ($fullMatrix, $kriterias) {
            // Delete all previous comparisons via transactional delete
            DB::table('ahp_comparisons')->delete();

            // Insert new comparisons
            foreach ($fullMatrix as $k1Id => $row) {
                foreach ($row as $k2Id => $val) {
                    AhpComparison::create([
                        'kriteria_pertama_id' => $k1Id,
                        'kriteria_kedua_id' => $k2Id,
                        'nilai' => $val,
                    ]);
                }
            }

            // Run calculations
            $results = $this->calculateAHP($fullMatrix);

            // Delete old results via transactional delete
            DB::table('ahp_results')->delete();

            // Store new results in ahp_results table
            foreach ($results['weights'] as $kId => $weight) {
                AhpResult::create([
                    'kriteria_id' => $kId,
                    'bobot' => $weight,
                    'lambda_max' => $results['lambda_max'],
                    'consistency_index' => $results['ci'],
                    'consistency_ratio' => $results['cr'],
                    'is_consistent' => $results['is_consistent'],
                ]);

                // 3. Cache weights in kriterias table ONLY IF consistency is satisfied
                if ($results['is_consistent']) {
                    Kriteria::where('id', $kId)->update(['bobot' => $weight]);
                }
            }

            return $results;
        });
    }
}
