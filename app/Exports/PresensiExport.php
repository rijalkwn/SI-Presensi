<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                'NIK' => $item->nik,
                'Nama' => $item->nama,
                'Status Kepegawaian' => $item->status_kepegawaian,
                'Tanggal' => $item->tanggal,
                'Jam Masuk' => $item->jam_masuk,
                'Jam Pulang' => $item->jam_pulang,
                'Keterangan' => $item->keterangan,
                'Status' => $item->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Status Kepegawaian',
            'Tanggal',
            'Jam Masuk',
            'Jam Pulang',
            'Keterangan',
            'Status',
        ];
    }
}
