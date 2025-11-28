<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::query();

        // Filter jurusan
        if ($request->jurusan) {
            $mahasiswa->where('jurusan', $request->jurusan);
        }

        $mahasiswa = $mahasiswa->paginate(10)->withQueryString();

        return view('apps.data-mahasiswa', compact('mahasiswa'));
    }

    public function create(){
        return view('apps.forms.tambah-mahasiswa');
    }

    public function store(Request $request)
    {
        // Jika upload Excel
        if ($request->hasFile('excel')) {
            Excel::import(new MahasiswaImport, $request->file('excel'));

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Data mahasiswa berhasil diimport!');
        }

        // Jika input manual
        $validated = $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required|numeric',
            'status' => 'required',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }


    public function edit($id){
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('apps.forms.edit-mahasiswa', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus.');
    }

}
