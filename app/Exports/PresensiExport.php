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
        // filter kolom created_at dan updated_at dari data sebelum diexport
        $data = collect($this->data)->map(function ($item) {
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['hadir_tepat_waktu'] = $item['hadir_tepat_waktu'] ?? 0;
            $item['hadir_terlambat'] = $item['hadir_terlambat'] ?? 0;
            $item['izin'] = $item['izin'] ?? 0;
            $item['sakit'] = $item['sakit'] ?? 0;
            return $item;
        });

        return $data;
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
