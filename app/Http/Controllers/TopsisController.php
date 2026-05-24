<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\TopsisResult;
use App\Models\ActivityLog;
use App\Services\TopsisService;
use Illuminate\Support\Facades\Auth;

class TopsisController extends Controller
{
    protected TopsisService $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    /**
     * Display TOPSIS calculation analytical panel.
     */
    public function index(Request $request)
    {
        $quota = (int)$request->query('quota', 5);
        if ($quota < 1) $quota = 1;

        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        $wargas = Warga::all();

        // Run/Re-evaluate on the fly to populate visual grids
        $calcData = $this->topsisService->calculateTOPSIS($quota);

        // Fetch stored results for final ranking list view
        $storedResults = TopsisResult::with('warga')->orderBy('ranking', 'asc')->get();

        return view('topsis.index', compact('kriterias', 'wargas', 'calcData', 'storedResults', 'quota'));
    }

    /**
     * Re-calculate TOPSIS values and update DB status.
     */
    public function calculate(Request $request)
    {
        // Restrict write access to admin and petugas roles
        if (!in_array(Auth::user()->role, ['admin', 'petugas'])) {
            return back()->with('error', 'Hanya Administrator dan Petugas yang dapat memproses seleksi bantuan sosial.');
        }

        $quota = (int)$request->input('quota', 5);
        if ($quota < 1) {
            return back()->with('error', 'Kuota penerima bantuan sosial minimal bernilai 1.');
        }

        // Execute TOPSIS calculations
        $calcData = $this->topsisService->calculateTOPSIS($quota);

        // Log admin activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Seleksi TOPSIS',
            'deskripsi' => 'Berhasil memproses perangkingan TOPSIS terhadap ' . count($calcData['alternatives']) . ' warga dengan kuota penerima ' . $quota . ' orang.',
        ]);

        return redirect()->route('topsis.index', ['quota' => $quota])
                         ->with('success', 'Perhitungan & perangkingan TOPSIS berhasil diperbarui! Hasil seleksi telah disimpan di database.');
    }

    /**
     * Returns step-by-step intermediate details for a single warga via JSON.
     */
    public function detailMath($wargaId)
    {
        $warga = Warga::find($wargaId);
        if (!$warga) {
            return response()->json(['error' => 'Warga tidak ditemukan'], 404);
        }

        // Calculate to grab the intermediate data objects
        $calcData = $this->topsisService->calculateTOPSIS();

        $alternative = $calcData['alternatives'][$wargaId] ?? null;
        if (!$alternative) {
            return response()->json(['error' => 'Data alternatif tidak ditemukan dalam perhitungan'], 404);
        }

        $kriterias = Kriteria::orderBy('kode', 'asc')->get();
        
        $wargaScores = [];
        $wargaNorm = [];
        $wargaWeighted = [];

        foreach ($kriterias as $k) {
            $wargaScores[$k->kode] = $calcData['decision_matrix'][$wargaId][$k->id] ?? 0;
            $wargaNorm[$k->kode] = $calcData['normalized_matrix'][$wargaId][$k->id] ?? 0;
            $wargaWeighted[$k->kode] = $calcData['weighted_normalized_matrix'][$wargaId][$k->id] ?? 0;
        }

        return response()->json([
            'nama' => $warga->nama_lengkap,
            'nik' => $warga->nik,
            'desa' => $warga->desa,
            'scores' => $wargaScores,
            'normalized' => $wargaNorm,
            'weighted' => $wargaWeighted,
            'd_plus' => $alternative['d_plus'],
            'd_minus' => $alternative['d_minus'],
            'v' => $alternative['v'],
            'ranking' => $alternative['ranking'],
            'status' => $alternative['status'],
        ]);
    }
}
