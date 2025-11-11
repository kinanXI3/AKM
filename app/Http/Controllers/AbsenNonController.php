<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonMahasiswa;

class AbsenNonController extends Controller
{
    public function storeNonMahasiswa(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'keperluan' => 'required|string|max:500',
        ]);

        NonMahasiswa::create($data);

        return redirect()->back()->with([
            'absen_status' => 'success',
            'absen_message' => 'Absensi berhasil tersimpan!',
        ]);
    }
}
