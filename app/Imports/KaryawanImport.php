<?php

namespace App\Imports;

use App\Models\Karyawan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KaryawanImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['status kepegawaian'] == 'Guru Tidak Tetap') {
            $status = 1;
        } elseif ($row['status kepegawaian'] == 'Pegawai Tidak Tetap') {
            $status = 2;
        } elseif ($row['status kepegawaian'] == 'Guru Tamu') {
            $status = 3;
        }

        // insert data ke tabel User and tb_mahasiswa
        $user = User::create([
            'nik' => $row['nik'],
            'email' => $row['email'],
            'nama' => $row['nama'],
            'role' => 'user',
            'password' => bcrypt($row['nik']),
        ]);

        $user = Karyawan::create([
            'nik' => $row['nik'],
            'email' => $row['email'],
            'nama' => $row['nama'],
            'kepegawaian_id' => $status,
        ]);

        return $user;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'kepegawaian_id' => 'required',
        ];
    }
}
