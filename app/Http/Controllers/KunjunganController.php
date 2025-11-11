<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kunjungan;

class KunjunganController extends Controller
{
    //Kunjungan
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $search = $request->input('search');

        // Query kunjungan mahasiswa
        $queryMahasiswa = DB::table('kunjungan')
            ->select(
                'nim',
                'nama',
                'tanggal',
                'waktu',
                'metode',
                DB::raw('"Mahasiswa" as kategori')
            );

        // Query kunjungan non-mahasiswa
        $queryNonMahasiswa = DB::table('non_mahasiswa')
            ->select(
                DB::raw('instansi as nim'),
                'nama',
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('TIME(created_at) as waktu'),
                DB::raw('"Manual" as metode'),
                DB::raw('"Non-Mahasiswa" as kategori')
            );

        // Gabungkan keduanya
        $query = $queryMahasiswa->unionAll($queryNonMahasiswa);

        // Bungkus hasil union untuk filter & paginate
        $kunjungan = DB::query()->fromSub($query, 'u')
            ->when($tanggal, fn($q) => $q->whereDate('tanggal', $tanggal))
            ->when($search, fn($q) =>
                $q->where('nim', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%")
            )
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(10);

        return view('apps.data-kunjungan', compact('kunjungan'));
    }

    //Riwayat Kunjungan
    public function riwayat(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $search = $request->input('search');

        // Query mahasiswa
        $queryMahasiswa = DB::table('kunjungan')
            ->select(
                'nim',
                'nama',
                'tanggal',
                'waktu',
                'metode',
                DB::raw('"Mahasiswa" as kategori')
            );

        // Query non-mahasiswa
        $queryNonMahasiswa = DB::table('non_mahasiswa')
            ->select(
                DB::raw('instansi as nim'),
                'nama',
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('TIME(created_at) as waktu'),
                DB::raw('"Manual" as metode'),
                DB::raw('"Non-Mahasiswa" as kategori')
            );

        // Gabungkan hasil
        $query = $queryMahasiswa->unionAll($queryNonMahasiswa);

        // Bungkus hasil union untuk filter & paginate
        $riwayat = DB::query()->fromSub($query, 'u')
            ->when($tanggal, fn($q) => $q->whereDate('tanggal', $tanggal))
            ->when($search, fn($q) =>
                $q->where('nim', 'like', "%$search%")
                  ->orWhere('nama', 'like', "%$search%")
            )
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu')
            ->paginate(10);

        return view('apps.riwayat-kunjungan', compact('riwayat'));
    }
}
