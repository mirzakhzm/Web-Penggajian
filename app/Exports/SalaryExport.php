<?php

namespace App\Exports;

use App\Models\Salari;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalaryExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Salari::with('payment')->get()->map(function ($item) {
            return [
                'Nama Karyawan'     => $item->nama_karyawan,
                'Bulan'             => $item->bulan,
                'Total Gaji'        => $item->total_diterima,
                'Status Pengajuan'  => $item->status_pengajuan,
                'Status Pembayaran' => optional($item->payment)->status_pembayaran ?? '-',
                'Tanggal Pembayaran'=> optional($item->payment)->tanggal_pembayaran ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Bulan',
            'Total Gaji',
            'Status Pengajuan',
            'Status Pembayaran',
            'Tanggal Pembayaran',
        ];
    }
}
