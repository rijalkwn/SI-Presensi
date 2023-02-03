<?php

namespace App\Imports;

use App\Models\Kepegawaian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KepegawaianImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['status kepegawaian'] == 'Guru Tidak Tetap') {
            $row['id'] = 1;
        } elseif ($row['status kepegawaian'] == 'Pegawai Tidak Tetap') {
            $row['id'] = 2;
        } elseif ($row['status kepegawaian'] == 'Guru Tamu') {
            $row['id'] = 3;
        }
        $kepegawaian = Kepegawaian::create([
            'id' => $row['id'],
            'status_kepegawaian' => $row['status kepegawaian'],
        ]);
        return $kepegawaian;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|unique:kepegawaians,id',
            'status kepegawaian' => 'required',
        ];
    }
}
