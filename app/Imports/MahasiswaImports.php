<?php
namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MahasiswaImports implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Mulai dari baris kedua untuk mengabaikan header
    }

    public function model(array $row)
    {
        return new Mahasiswa([
            'nim'       => $row[0],
            'nama'      => $row[1],
            'jurusan'   => $row[2],
            'angkatan'  => $row[3],
            'status'    => $row[4],
        ]);
    }
}
