<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Karyawan;
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
        if ($row['status_kepegawaian'] == 'Guru Tidak Tetap') {
            $status = 1;
        } elseif ($row['status_kepegawaian'] == 'Pegawai Tidak Tetap') {
            $status = 2;
        } elseif ($row['status_kepegawaian'] == 'Guru Tamu') {
            $status = 3;
        }
        $user = User::create([
            'nik' => str_replace(' ', '', $row['nik']),
            'nama' => $row['nama'],
            'email' => str_replace(' ', '', $row['email']),
            'role' => 'user',
            'password' => bcrypt(str_replace(' ', '', $row['nik'])),
        ]);

        $user = Karyawan::create([
            'nik' => str_replace(' ', '', $row['nik']),
            'nama' => $row['nama'],
            'email' => str_replace(' ', '', $row['email']),
            'kepegawaian_id' => $status,
        ]);


        return $user;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:karyawans,nik',
            'nama' => 'required',

        ];
    }
}
