<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nik'      => str_replace(' ', '', $row['nik']),
            'nama'     => $row['nama'],
            'email'    => str_replace(' ', '', $row['email']),
            'role'     => 'user',
            'password' => Hash::make(str_replace(' ', '', $row['nik'])),
        ]);
    }
}
