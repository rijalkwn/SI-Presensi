<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Kepegawaian;
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
        $user = User::create([
            'nik' => str_replace(' ', '', $row['nik']),
            'nama' => $row['nama'],
            'email' => str_replace(' ', '', $row['email']),
            'role' => 'user',
            'password' => bcrypt(str_replace(' ', '', $row['nik'])),
        ]);

        $kepegawaian = Kepegawaian::where('status_kepegawaian', $row['status_kepegawaian'])->first();
        $status = $kepegawaian->id;
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
            'email' => 'required|unique:karyawans,email',

        ];
    }
}
