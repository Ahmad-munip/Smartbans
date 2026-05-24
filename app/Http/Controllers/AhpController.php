<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\AhpResult;
use App\Models\ActivityLog;
use App\Services\AhpService;
use Illuminate\Support\Facades\Auth;

class AhpController extends Controller
{
    protected AhpService $ahpService;

    public function __construct(AhpService $ahpService)
    {
        $this->ahpService = $ahpService;
    }

    /**
     * Display AHP Matrix Page.
     */
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $matrix = $this->ahpService->getMatrix();
        
        // Calculate on-the-fly to get current calculations based on the DB matrix
        $calcResults = $this->ahpService->calculateAHP($matrix);

        // Fetch stored results for display
        $storedResults = AhpResult::with('kriteria')->get()->keyBy('kriteria_id');

        return view('ahp.index', compact('kriterias', 'matrix', 'calcResults', 'storedResults'));
    }

    /**
     * Process AHP matrix calculations and save judgments.
     */
    public function calculate(Request $request)
    {
        // Require admin or petugas role
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return back()->with('error', 'Anda tidak memiliki wewenang untuk mengubah perbandingan AHP.');
        }

        $matrixInput = $request->input('matrix', []);

        // Save and run mathematical calculations
        $results = $this->ahpService->saveMatrix($matrixInput);

        $crFormatted = number_format($results['cr'], 4);

        if ($results['is_consistent']) {
            // Log successful consistent run
            ActivityLog::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Analisis AHP',
                'deskripsi' => 'Berhasil memperbarui matriks AHP. Hasil KONSISTEN dengan nilai CR = ' . $crFormatted . '.',
            ]);

            return redirect()->route('ahp.index')->with('success', 'Perhitungan AHP berhasil disimpan! Hasil perbandingan KONSISTEN (CR = ' . $crFormatted . ' <= 0.1).');
        } else {
            // Log inconsistent run
            ActivityLog::create([
                'user_id' => Auth::id(),
                'aktivitas' => 'Analisis AHP Gagal',
                'deskripsi' => 'Melakukan pembaruan matriks AHP, namun hasil TIDAK KONSISTEN (CR = ' . $crFormatted . ' > 0.1).',
            ]);

            return redirect()->route('ahp.index')->with('warning', 'Perhitungan AHP disimpan, namun hasil perbandingan TIDAK KONSISTEN (CR = ' . $crFormatted . ' > 0.1). Bobot kriteria di database tidak diperbarui untuk perhitungan TOPSIS selanjutnya.');
        }
    }
}
