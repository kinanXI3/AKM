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
            'nim' => 'required',
            'nama' => 'required',
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)
            ->where('nama', $request->nama)
            ->first();

        if ($mahasiswa) {
            // Insert new kunjungan
            Kunjungan::create([
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'tanggal' => now()->toDateString(),
                'waktu' => now()->toTimeString(),
                'metode' => 'Manual'
            ]);

            return redirect()->back()->with([
                'absen_status' => 'success',
                'absen_message' => 'Berhasil masuk absen!',
            ]);
        } else {
            return redirect()->back()->with([
                'absen_status' => 'fail',
                'absen_message' => 'NIM atau Nama tidak ditemukan!',
            ]);
        }
    }
}
