<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KaryawanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['status_kepegawaian'] == 'Guru Tidak Tetap') {
            $status = 1;
        } elseif ($row['status_kepegawaian'] == 'Pegawai Tidak Tetap') {
            $status = 2;
        } elseif ($row['status_kepegawaian'] == 'Guru Tamu') {
            $status = 3;
        }
        return new Karyawan([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'kepegawaian_id' => $status,
        ]);
    }
}
