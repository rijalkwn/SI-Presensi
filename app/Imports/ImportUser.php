<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUser implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = new User;
        $user->nik = str_replace(' ', '', $row['nik']);
        $user->nama = $row['nama'];
        $user->email = str_replace(' ', '', $row['email']);
        $user->role = 'user';
        $user->password = Hash::make(str_replace(' ', '', $row['nik']));
        $user->save();

        return $user;
    }
}
