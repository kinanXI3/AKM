<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    //  Menampilkan data kunjungan hari ini
    public function index(Request $request)
    {
        // Ambil data kunjungan untuk hari ini
        // Jika ada pencarian (search), filter berdasarkan NIM atau Nama
        $kunjungan = Kunjungan::today()
                    ->when($request->search, fn($q) =>
                        $q->where('nim', 'like', '%' . $request->search . '%')
                          ->orWhere('nama', 'like', '%' . $request->search . '%')
                    )
                    // Urutkan berdasarkan waktu
                    ->orderBy('waktu','asc')
                    //paginasi 15 data per halaman
                    ->paginate(15)
                    ->withQueryString(); // agar query search tetap ada saat pindah halaman

        // Kirim data ke view
        return view('apps.data-kunjungan', compact('kunjungan'));
    }

    //  riwayat kunjungan
    public function riwayat(Request $request)
    {
        $query = Kunjungan::query();

        // Filter berdasarkan tanggal tertentu
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);

        } else {
            // Jika tidak memilih tanggal,
            // akan menampilkan data yang sudah ditandai sebagai riwayat (is_history = true)
            // atau tanggal kunjungannya sudah lewat hari ini
            $today = now()->setTimezone(config('app.timezone'))->toDateString();

            $query->where(function($q) use ($today) {
                $q->where('is_history', true)
                  ->orWhereDate('tanggal', '<', $today);
            });
        }

        // Filter berdasarkan pencarian (NIM atau Nama)
        $riwayat = $query
            ->when($request->search, fn($q) =>
                $q->where('nim', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%')
            )
            // Urutkan dari tanggal terbaru → terlama
            ->orderBy('tanggal', 'desc')
            // Jika tanggal sama, urutkan berdasarkan waktu terbaru → terlama
            ->orderBy('waktu', 'desc')
            // Paginasi 15 data
            ->paginate(15)
            ->withQueryString();

        // Kirim data ke view
        return view('apps.riwayat-kunjungan', compact('riwayat'));
    }
}
