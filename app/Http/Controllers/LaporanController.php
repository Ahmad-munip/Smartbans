<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\TopsisResult;
use App\Models\AhpResult;
use App\Services\TopsisService;
use App\Services\AhpService;

class LaporanController extends Controller
{
    protected TopsisService $topsisService;

    public function __construct(TopsisService $topsisService)
    {
        $this->topsisService = $topsisService;
    }

    /**
     * Display the Reports Selector Panel.
     */
    public function index(Request $request)
    {
        $type = $request->query('type', 'warga');
        $desa = $request->query('desa', '');
        $status = $request->query('status', '');

        // Fetch villages for filter dropdown
        $villages = Warga::select('desa')->groupBy('desa')->pluck('desa')->toArray();

        // Count summaries for cards
        $totalWarga = Warga::count();
        $totalKriteria = Kriteria::count();
        $totalTopsis = TopsisResult::count();
        $totalLayak = TopsisResult::where('status', 'layak')->count();

        // Fetch data based on active report type
        $data = $this->getReportData($type, $desa, $status);

        return view('laporan.index', compact(
            'type', 'desa', 'status', 'villages', 'totalWarga', 
            'totalKriteria', 'totalTopsis', 'totalLayak', 'data'
        ));
    }

    /**
     * Renders high-fidelity print window layout with Kop and trigger window.print()
     */
    public function cetak(Request $request)
    {
        $type = $request->query('type', 'warga');
        $desa = $request->query('desa', '');
        $status = $request->query('status', '');

        $data = $this->getReportData($type, $desa, $status);
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();

        // If AHP report, we also need extra details
        $ahpSummary = null;
        if ($type === 'ahp') {
            $ahpSummary = AhpResult::with('kriteria')->first();
        }

        return view('laporan.print_' . $type, compact('data', 'desa', 'status', 'kriterias', 'ahpSummary'));
    }

    /**
     * Serves styled Excel stream XLS
     */
    public function excel(Request $request)
    {
        $type = $request->query('type', 'warga');
        $desa = $request->query('desa', '');
        $status = $request->query('status', '');

        $data = $this->getReportData($type, $desa, $status);
        $kriterias = Kriteria::orderBy('kode', 'asc')->get();

        $ahpSummary = null;
        if ($type === 'ahp') {
            $ahpSummary = AhpResult::with('kriteria')->first();
        }

        $filename = 'laporan_' . $type . '_' . date('Ymd_His') . '.xls';

        return response()->streamDownload(function () use ($type, $data, $desa, $status, $kriterias, $ahpSummary) {
            echo view('laporan.excel_' . $type, compact('data', 'desa', 'status', 'kriterias', 'ahpSummary'))->render();
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Core Data Aggregator for Reports
     */
    private function getReportData(string $type, string $desa, string $status)
    {
        switch ($type) {
            case 'warga':
                $query = Warga::query();
                if ($desa) {
                    $query->where('desa', $desa);
                }
                return $query->orderBy('nama_lengkap', 'asc')->get();

            case 'ahp':
                // Simply list Criteria with their bobots
                return Kriteria::orderBy('kode', 'asc')->get();

            case 'topsis':
                // Enforce calculated values exist
                $query = TopsisResult::with('warga');
                if ($desa) {
                    $query->whereHas('warga', function ($q) use ($desa) {
                        $q->where('desa', $desa);
                    });
                }
                if ($status) {
                    $dbStatus = ($status === 'tidak layak') ? 'tidak_layak' : $status;
                    $query->where('status', $dbStatus);
                }
                return $query->orderBy('ranking', 'asc')->get();

            case 'penerima':
                // Filter only citizens marked as 'layak'
                $query = TopsisResult::with('warga')->where('status', 'layak');
                if ($desa) {
                    $query->whereHas('warga', function ($q) use ($desa) {
                        $q->where('desa', $desa);
                    });
                }
                return $query->orderBy('ranking', 'asc')->get();

            default:
                return collect([]);
        }
    }
}
