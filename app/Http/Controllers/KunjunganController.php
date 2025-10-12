<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Kunjungan::query();

        // Filter Tanggal
        if ($request->filled('tanggal')){
            $query->whereDate('tanggal', $request->tanggal);
        }

        //Pencarian Nim
        if ($request->filled('search')){
            $query->where(function($q) use ($request){
                $q->where('nim', 'like', '%'.$request->search.'%')
                  ->orWhere('nama', 'like', '%'.$request->search.'%');
            });
        }

        $kunjungan = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('apps.data-kunjungan', compact('kunjungan'));
    }

    public function riwayat(Request $request)
    {
        $query = Kunjungan::query();

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Search by NIM or Nama
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nim', 'like', '%'.$request->search.'%')
                  ->orWhere('nama', 'like', '%'.$request->search.'%');
            });
        }

        $riwayat = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('apps.riwayat-kunjungan', compact('riwayat'));
    }
}
