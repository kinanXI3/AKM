<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        return view('statistik');
    }

    public function getData(Request $request)
    {
        // Ambil statistik dari tabel kunjungan
        $metode = DB::table('kunjungan')
            ->select('metode', DB::raw('COUNT(*) as total'))
            ->groupBy('metode')
            ->pluck('total', 'metode');

        $jurusan = DB::table('kunjungan')
            ->select('jurusan', DB::raw('COUNT(*) as total'))
            ->groupBy('jurusan')
            ->pluck('total', 'jurusan');

        $hari = DB::table('kunjungan')
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('COUNT(*) as total'))
            ->whereBetween('tanggal', [now()->subDays(6), now()])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        return response()->json([
            'metode' => $metode,
            'jurusan' => $jurusan,
            'hari' => $hari,
            'total_pengunjung' => DB::table('kunjungan')->count(),
            'total_mahasiswa' => DB::table('kunjungan')->where('status', 'Mahasiswa')->count(),
            'total_tamu' => DB::table('kunjungan')->where('status', 'Tamu')->count(),
        ]);
    }
}
