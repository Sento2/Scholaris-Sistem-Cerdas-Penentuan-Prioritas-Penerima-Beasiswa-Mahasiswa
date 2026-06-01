<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenerimaBeasiswaExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengajuan::with('mahasiswa.user')
            ->where('status', Pengajuan::STATUS_DITERIMA)
            ->orderBy('rank')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Ranking',
            'Nama Mahasiswa',
            'NIM',
            'Program Studi',
            'Angkatan',
            'No. HP',
            'Skor Akhir SAW',
        ];
    }

    public function map($pengajuan): array
    {
        return [
            $pengajuan->rank,
            $pengajuan->mahasiswa->user->name ?? 'Unknown',
            $pengajuan->mahasiswa->nim,
            $pengajuan->mahasiswa->prodi,
            $pengajuan->mahasiswa->angkatan,
            $pengajuan->mahasiswa->no_hp,
            number_format($pengajuan->skor_saw, 3),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style baris pertama (header) menjadi bold.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
