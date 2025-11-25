<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kunjungan;

class AbsenController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if (! $mahasiswa) {
            return redirect()->back()->with([
                'absen_status' => 'fail',
                'absen_message' => 'NIM tidak ditemukan!',
            ]);
        }

        // Optional: prevent duplicate absen same day
        // if (Kunjungan::where('nim', $mahasiswa->nim)->whereDate('tanggal', now())->exists()) {
        //     return redirect()->back()->with([
        //         'absen_status' => 'fail',
        //         'absen_message' => 'Sudah absen hari ini.',
        //     ]);
        // }

        Kunjungan::create([
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s'),
            'metode' => 'Manual',
        ]);

        return redirect()->back()->with([
            'absen_status' => 'success',
            'absen_message' => 'Berhasil Masuk Absen!',
        ]);
    }
}
