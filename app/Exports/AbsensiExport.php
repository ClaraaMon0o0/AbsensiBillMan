<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = Absensi::with('user');

        if ($this->tanggal) {
            $query->where('tanggal', $this->tanggal);
        }

        return $query->get()->map(function ($absensi) {
            return [
                'Nama' => $absensi->user->name,
                'Tanggal' => $absensi->tanggal,
                'Kegiatan' => $absensi->kegiatan,
                'Keterangan' => $absensi->keterangan,
                'Status' => $absensi->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Tanggal',
            'Kegiatan',
            'Keterangan',
            'Status',
        ];
    }
}
