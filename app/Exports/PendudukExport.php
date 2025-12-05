<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */

    protected $records;

    public function __construct($records = null)
    {
        $this->records = $records;
    }

    public function collection()
    {
        if ($this->records) {
            return $this->records;
        }

        return Penduduk::with(['creator', 'updater'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Keluarga',
            'Alamat',
            'RT',
            'RW',
            'Agama',
            'Pekerjaan',
            'Status Perkawinan',
            'Disabilitas',
            'Keterangan Tambahan',
            'Status Aktif',
            'Dibuat Tanggal',
        ];
    }

    public function map($penduduk): array
    {
        return [
            $penduduk->nama_lengkap,
            $penduduk->jenis_kelamin == 'L' ? 'L' : 'P',
            $penduduk->tempat_lahir ?? '-',
            $penduduk->tanggal_lahir ? $penduduk->tanggal_lahir->format('d/m/Y') : '-',
            ucwords($penduduk->status_keluarga ?? '-'),
            $penduduk->alamat ?? '-',
            $penduduk->rt ?? '-',
            $penduduk->rw ?? '-',
            ucwords($penduduk->agama ?? '-'),
            $penduduk->pekerjaan ?? '-',
            ucwords($penduduk->status_perkawinan ?? '-'),
            ucwords($penduduk->disabilitas ?? '-'),
            $penduduk->keterangan_tambahan ?? '-',
            $penduduk->is_active ? 'Aktif' : 'Tidak Aktif',
            $penduduk->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
