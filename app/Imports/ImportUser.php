<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportUser implements ToModel, WithHeadingRow, WithValidation
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
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|unique:karyawans,nik',
            'nama' => 'required',

        ];
    }
}
