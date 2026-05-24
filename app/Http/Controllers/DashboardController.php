<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\ActivityLog;
use App\Models\TopsisResult;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $wargaCount = Warga::count();
        $kriteriaCount = Kriteria::count();
        $subKriteriaCount = SubKriteria::count();
        $bantuanAktifCount = Warga::where('status_bantuan_sebelumnya', 'Pernah (Aktif)')->count();

        // Get recent activities
        $recentActivities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Fetch Top 5 TOPSIS rankings for preview in the dashboard
        $topTopsis = TopsisResult::with('warga')
            ->orderBy('ranking', 'asc')
            ->take(5)
            ->get();

        // Chart Data 1: Citizens distribution by Village (Desa)
        $wargaByDesa = Warga::select('desa', DB::raw('count(*) as total'))
            ->groupBy('desa')
            ->get();

        $desaLabels = $wargaByDesa->pluck('desa')->toArray();
        $desaTotals = $wargaByDesa->pluck('total')->toArray();

        // Chart Data 2: Citizens distribution by Previous Aid Status
        $wargaByStatus = Warga::select('status_bantuan_sebelumnya', DB::raw('count(*) as total'))
            ->groupBy('status_bantuan_sebelumnya')
            ->get();

        $statusLabels = $wargaByStatus->pluck('status_bantuan_sebelumnya')->toArray();
        $statusTotals = $wargaByStatus->pluck('total')->toArray();

        return view('dashboard.index', compact(
            'wargaCount',
            'kriteriaCount',
            'subKriteriaCount',
            'bantuanAktifCount',
            'recentActivities',
            'topTopsis',
            'desaLabels',
            'desaTotals',
            'statusLabels',
            'statusTotals'
        ));
    }
}
