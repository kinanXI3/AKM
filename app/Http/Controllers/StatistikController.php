<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        return view('apps.statistik-kunjungan');
    }

    public function getData()
    {
        // Total pengunjung hari ini
        $today = Carbon::today();
        $totalHariIni = DB::table('kunjungan')
            ->whereDate('tanggal', $today)
            ->count();

        // Total bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $totalBulanIni = DB::table('kunjungan')
            ->whereBetween('tanggal', [$startOfMonth, $today])
            ->count();

        // Total keseluruhan
        $totalKeseluruhan = DB::table('kunjungan')->count();

        // Statistik metode
        $metodeStats = DB::table('kunjungan')
            ->select('metode', DB::raw('COUNT(*) as total'))
            ->groupBy('metode')
            ->get();

        // Data chart (7 hari terakhir)
        $dataChart = DB::table('kunjungan')
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('COUNT(*) as total'))
            ->where('tanggal', '>=', Carbon::now()->subDays(6))
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy('tanggal')
            ->get();

        return response()->json([
            'totalHariIni' => $totalHariIni,
            'totalBulanIni' => $totalBulanIni,
            'totalKeseluruhan' => $totalKeseluruhan,
            'metodeStats' => $metodeStats,
            'chart' => [
                'labels' => $dataChart->pluck('tanggal'),
                'data' => $dataChart->pluck('total'),
            ]
        ]);
    }
}
