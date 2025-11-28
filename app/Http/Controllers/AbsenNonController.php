<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kunjungan;

class AbsenNonController extends Controller
{
    // Method untuk menyimpan data absensi Non-Mahasiswa
    public function storeNonMahasiswa(Request $request)
    {
        // Validasi input form sebelum diproses
        $request->validate([
            'nama' => 'required|string|max:255',     
            'instansi' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
        ]);

        // Menyimpan data absensi ke tabel 'kunjungan'
        Kunjungan::create([
            // Karena Non-Mahasiswa tidak punya NIM, nim diganti dengan info instansi
            'nim' => 'Instansi: ' . $request->instansi,

            // Menyimpan nama pengunjung
            'nama' => $request->nama,

            // Menyimpan tanggal absensi (format Y-m-d)
            'tanggal' => now()->toDateString(),

            // Menyimpan waktu absensi (format H:i:s)
            'waktu'   => now()->toTimeString(),

            // Menandai metode absensi yang digunakan
            'metode' => 'Manual',

            // Kategori khusus untuk Non-Mahasiswa
            'kategori' => 'Non-Mahasiswa',

            // Menyimpan keperluan kunjungan
            'keperluan' => $request->keperluan,

            // Menandai bahwa data belum dipindahkan ke history
            'is_history' => false,
        ]);

        // Mengirim notifikasi keberhasilan kembali ke halaman sebelumnya
        return redirect()->back()
            ->with('absen_status', 'success')
            ->with('absen_message', 'Absen berhasil!');
    }
}
