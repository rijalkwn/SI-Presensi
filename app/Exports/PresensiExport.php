<?php

namespace App\Exports;

use App\Models\Presensi;
use App\Models\RekapPresensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PresensiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }


    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama',
            'Status Kepegawaian',
            'Bulan',
            'Tahun',
            'Hadir Tepat Waktu',
            'Hadir Terlambat',
            'Izin',
            'Sakit',
        ];
    }
}
