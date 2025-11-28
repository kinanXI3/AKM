<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KunjunganController;
use App\Models\Mahasiswa;
use App\Http\Controllers\ForbiddenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AbsenNonController;
use App\Http\Controllers\StatistikController;
use Illuminate\Support\Facades\Route;
use App\Models\Kunjungan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [ForbiddenController::class, 'showForbiddenPage'])->name('forbidden');

Route::get('/register', function(){
    return view('auth.register');
});

Route::get('/dashboard', function () {
    $totalHariIni = Kunjungan::where('tanggal', now()->toDateString())->count();
    return view('dashboard', compact('totalHariIni'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Isi Aplikasi
Route::get('/data-mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('data-mahasiswa');

Route::get('/data-kunjungan', [KunjunganController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('data-kunjungan');

Route::get('/riwayat-kunjungan', [KunjunganController::class, 'riwayat'])
    ->middleware(['auth', 'verified'])
    ->name('riwayat-kunjungan');

Route::get('/statistik-kunjungan', function () {
    return view('apps.statistik-kunjungan');
})->middleware(['auth', 'verified'])->name('statistik-kunjungan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('kunjungan', KunjunganController::class);

Route::post('/absen/check', [AbsenController::class, 'check'])->name('absen.check');
Route::get('/absen/nonmahasiswa', function () {
    return view('welcome'); // ganti 'absen.index' sesuai nama file blade kamu
})->name('absen.nonmahasiswa.form');
Route::post('/absen/nonmahasiswa', [AbsenNonController::class, 'storeNonMahasiswa'])->name('absen.nonmahasiswa');

Route::get('/statistik-kunjungan', [StatistikController::class, 'index'])
    ->name('statistik-kunjungan');

Route::get('/statistik/data', [StatistikController::class, 'getData'])
    ->name('statistik.data');

Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
Route::get('/kunjungan/riwayat', [KunjunganController::class, 'riwayat'])->name('kunjungan.riwayat');


// Route::get('/contoh', [App\Http\Controllers\ContohController::class, 'index'])->name('contoh.index');
// Route::get('/contoh/create', [App\Http\Controllers\ContohController::class, 'create'])->name('contoh.create');

require __DIR__.'/auth.php';
