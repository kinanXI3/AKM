<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    // Menampilkan halaman statistik kunjungan
    public function index()
    {
        return view('apps.statistik-kunjungan');
    }

    // Mengambil data statistik untuk ditampilkan dalam bentuk JSON (Ajax)
    public function getData()
    {
        // menghitung Total Hari Ini
        $today = Carbon::today(); // Mendapatkan tanggal hari ini
        $totalHariIni = DB::table('kunjungan')
            ->whereDate('tanggal', $today) // Filter hanya data dengan tanggal hari ini
            ->count(); // Menghitung jumlahnya

        // menghitung Total Bulan Ini
        $startOfMonth = Carbon::now()->startOfMonth(); // Tanggal awal bulan berjalan
        $totalBulanIni = DB::table('kunjungan')
            ->whereBetween('tanggal', [$startOfMonth, $today]) // Filter tanggal awal bulan → hari ini
            ->count();

        // menghitung Total Keseluruhan
        $totalKeseluruhan = DB::table('kunjungan')->count(); // Menghitung semua data

        // Statistik Berdasarkan Metode Kunjungan
        //    (Manual / QR / RFID)
        $metodeStats = DB::table('kunjungan')
            ->select('metode', DB::raw('COUNT(*) as total')) // Hitung berdasarkan metode
            ->groupBy('metode') // Kelompokkan
            ->get();

        // Data Grafik (7 hari terakhir) untuk chart di dashboard
        $dataChart = DB::table('kunjungan')
            ->select(
                DB::raw('DATE(tanggal) as tanggal'), // Ambil tanggal saja
                DB::raw('COUNT(*) as total')        // Hitung jumlah kunjungan per tanggal
            )
            ->where('tanggal', '>=', Carbon::now()->subDays(6)) // Periode 7 hari terakhir
            ->groupBy(DB::raw('DATE(tanggal)')) // Kelompokkan per tanggal
            ->orderBy('tanggal') // Urutkan dari tanggal paling lama ke terbaru
            ->get();

        // Mengembalikan semua data dalam format JSON (API)
        return response()->json([
            'totalHariIni' => $totalHariIni,
            'totalBulanIni' => $totalBulanIni,
            'totalKeseluruhan' => $totalKeseluruhan,
            'metodeStats' => $metodeStats,
            'chart' => [
                'labels' => $dataChart->pluck('tanggal'), // Label tanggal chart
                'data' => $dataChart->pluck('total'),     // Jumlah kunjungan per hari
            ]
        ]);
    }
}
