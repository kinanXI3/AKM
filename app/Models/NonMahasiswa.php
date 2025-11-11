<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'non_mahasiswa';
    protected $fillable = ['nama', 'instansi', 'keperluan'];

}
