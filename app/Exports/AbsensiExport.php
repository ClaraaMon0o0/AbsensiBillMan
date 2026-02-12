<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class AbsensiExport implements
    FromCollection,
    WithHeadings,
    WithDrawings,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    protected $tanggal;
    protected $data;

    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;

        $query = Absensi::with('user');

        if ($this->tanggal) {
            $query->whereDate('tanggal', $this->tanggal);
        }

        $this->data = $query->get();
    }

    public function collection()
    {
        return $this->data->map(function ($absensi) {
            return [
                'Nama' => $absensi->user->name ?? '-',
                'Tanggal' => $absensi->tanggal->format('d-m-Y'),
                'Jam Absen' => Carbon::parse($absensi->created_at)
                    ->timezone('Asia/Jakarta')
                    ->format('H:i:s') . ' WIB',
                'Kegiatan' => $absensi->kegiatan,
                'Keterangan' => $absensi->keterangan,
                'Status' => $absensi->status,
                'Foto' => '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tanggal',
            'Jam Absen',
            'Kegiatan',
            'Keterangan',
            'Status',
            'Foto',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HEADER STYLE
    |--------------------------------------------------------------------------
    */

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | BORDER + ROW HEIGHT
    |--------------------------------------------------------------------------
    */

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $totalRows = $this->data->count() + 1;

                // Border semua tabel
                $event->sheet->getStyle('A1:G' . $totalRows)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Background header
                $event->sheet->getStyle('A1:G1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9D9D9'],
                    ],
                ]);

                // Tinggi row supaya muat gambar
                for ($i = 2; $i <= $totalRows; $i++) {
                    $event->sheet->getRowDimension($i)->setRowHeight(70);
                }
            },
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FOTO
    |--------------------------------------------------------------------------
    */

    public function drawings()
    {
        $drawings = [];
        $row = 2;

        foreach ($this->data as $absensi) {

            if ($absensi->foto_path) {

                $path = str_replace('/storage/', '', $absensi->foto_path);
                $fullPath = public_path('storage/' . $path);

                if (file_exists($fullPath)) {

                    $drawing = new Drawing();
                    $drawing->setName('Foto');
                    $drawing->setDescription('Foto Absensi');
                    $drawing->setPath($fullPath);
                    $drawing->setHeight(60);
                    $drawing->setCoordinates('G' . $row);

                    $drawings[] = $drawing;
                }
            }

            $row++;
        }

        return $drawings;
    }
}
