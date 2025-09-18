<?php

use App\Http\Controllers\MahasiswaController;
use App\Models\Mahasiswa;
use App\Http\Controllers\ForbiddenController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [ForbiddenController::class, 'showForbiddenPage'])->name('forbidden');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Isi Aplikasi
Route::get('/data-mahasiswa', function () {
    $mahasiswa = Mahasiswa::all();
    return view('apps.data-mahasiswa', compact('mahasiswa'));
})->middleware(['auth', 'verified'])->name('data-mahasiswa');

Route::get('/data-kunjungan', function () {
    return view('apps.data-kunjungan');
})->middleware(['auth', 'verified'])->name('data-kunjungan');

Route::get('/riwayat-kunjungan', function () {
    return view('apps.riwayat-kunjungan');
})->middleware(['auth', 'verified'])->name('riwayat-kunjungan');

Route::get('/statistik-kunjungan', function () {
    return view('apps.statistik-kunjungan');
})->middleware(['auth', 'verified'])->name('statistik-kunjungan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('mahasiswa', MahasiswaController::class);

// Route::get('/contoh', [App\Http\Controllers\ContohController::class, 'index'])->name('contoh.index');
// Route::get('/contoh/create', [App\Http\Controllers\ContohController::class, 'create'])->name('contoh.create');
require __DIR__.'/auth.php';
