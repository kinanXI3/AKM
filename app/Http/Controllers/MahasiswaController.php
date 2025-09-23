<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('apps.data-mahasiswa', compact('mahasiswa'));
    }

    public function create(){
        return view('apps.forms.tambah-mahasiswa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan.');
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
