<?php

namespace App\Imports;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

        // insert data ke tabel User and karyawan
        $user = User::create([
            'nik' => str_replace(' ', '', $row['nik']),
            'email' => str_replace(' ', '', $row['email'] ?? $row['nik'] . '@gmail.com'),
            'nama' => $row['nama'],
            'role' => 'user',
            'password' => Hash::make(str_replace(' ', '', $row['nik'])),
        ]);

        $user = Karyawan::create([
            'nik' => str_replace(' ', '', $row['nik']),
            'email' => str_replace(' ', '', $row['email'] ?? $row['nik'] . '@gmail.com'),
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
            'status_kepegawaian' => 'required',
        ];
    }
}
