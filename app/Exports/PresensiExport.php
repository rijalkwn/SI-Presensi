<?php

namespace App\Exports;

use App\Models\Presensi;
use App\Models\RekapPresensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PresensiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $data;
    protected $namaBulan;
    protected $date;
    protected $bulan;

    public function __construct($data, $date, $bulan)
    {
        $this->data = $data;
        $this->date = $date;
        $this->namaBulan = $data->isEmpty() ? $bulan : [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ][$data[0]['bulan'] - 1];
    }



    public function collection()
    {
        // filter kolom created_at dan updated_at dari data sebelum diexport
        $data = collect($this->data)->map(function ($item) {
            unset($item['created_at']);
            unset($item['updated_at']);
            $item['hadir_tepat_waktu'] = $item['hadir_tepat_waktu'] ?? 0;
            $item['hadir_terlambat'] = $item['hadir_terlambat'] ?? 0;
            $item['tidak_presensi_pulang'] = $item['tidak_presensi_pulang'] ?? 0;
            $item['izin'] = $item['izin'] ?? 0;
            $item['sakit'] = $item['sakit'] ?? 0;
            return $item;
        });

        return $data;
    }


    public function headings(): array
    {
        return [
            [
                'Di unduh pada ' . $this->date,
            ],
            [
                'Presensi Karyawan SMA Negeri 1 Prembun',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ],
            [
                'Bulan ' . $this->namaBulan,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ],
            [],
            [
                'No',
                'NIK',
                'Nama',
                'Status Kepegawaian',
                'Bulan',
                'Tahun',
                'Hadir Tepat Waktu',
                'Hadir Terlambat',
                'Tidak Presensi Pulang',
                'Izin',
                'Sakit',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge the first four columns of the first two rows
        $sheet->mergeCells('A1:D1');
        $sheet->mergeCells('A2:K2');
        $sheet->mergeCells('A3:K3');

        // Apply margin to the first row
        $sheet->getStyle('A1:D1')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Apply style to the second row
        $sheet->getStyle('A2:K2')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        // Apply style to the third row
        $sheet->getStyle('A3:K3')->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
            ],
        ]);

        //auto resize column
        foreach (range('A', 'K') as $columnID) {
            $sheet->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $border = [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ];
        $sheet->getStyle('A5:K' . $sheet->getHighestRow())->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => $border,
            ],
        ]);

        $lastRow = $sheet->getHighestRow();

        // Add empty row
        $sheet->insertNewRowBefore($lastRow + 2, 1);

        // Add date and place
        $sheet->setCellValue('I' . ($lastRow + 2), 'Prembun, ' . $this->date);
        $sheet->mergeCells('I' . ($lastRow + 2) . ':K' . ($lastRow + 2));
        $sheet->getStyle('I' . ($lastRow + 2) . ':K' . ($lastRow + 2))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        //kepala sekolah
        $sheet->setCellValue('I' . ($lastRow + 3), 'Kepala Sekolah');
        $sheet->mergeCells('I' . ($lastRow + 3) . ':K' . ($lastRow + 3));
        $sheet->getStyle('I' . ($lastRow + 3) . ':K' . ($lastRow + 3))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Add more empty rows
        $sheet->insertNewRowBefore($lastRow + 4, 3);

        // Add name
        $sheet->setCellValue('I' . ($lastRow + 7), 'Waluyo');
        $sheet->mergeCells('I' . ($lastRow + 7) . ':K' . ($lastRow + 7));
        $sheet->getStyle('I' . ($lastRow + 7) . ':K' . ($lastRow + 7))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        //add nip
        $sheet->setCellValue('I' . ($lastRow + 8), 'NIP. 19670512 198903 1 001');
        $sheet->mergeCells('I' . ($lastRow + 8) . ':K' . ($lastRow + 8));
        $sheet->getStyle('I' . ($lastRow + 8) . ':K' . ($lastRow + 8))->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}