<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PendudukImport implements ToModel, WithHeadingRow, WithValidation
{
    // /**
    // * @param array $row
    // *
    // * @return \Illuminate\Database\Eloquent\Model|null
    // */
    public function model(array $row)
    {
        $tanggalLahir = null;

        if (!empty($row['tanggal_lahir'])) {
            try {
                // KASUS A: Format Excel Murni (Angka Serial, misal: 44562)
                if (is_numeric($row['tanggal_lahir'])) {
                    $tanggalLahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])
                        ->format('Y-m-d'); // Konversi eksplisit ke String Y-m-d
                }
                // KASUS B: Format Text/String
                else {
                    // Bersihkan spasi tambahan jika ada
                    $cleanDate = trim($row['tanggal_lahir']);

                    // Coba parsing format Indonesia (dd/mm/yyyy atau dd-mm-yyyy)
                    // Carbon::parse() defaultnya sering menganggap format US (mm/dd/yyyy)
                    try {
                        $tanggalLahir = Carbon::createFromFormat('d/m/Y', $cleanDate)->format('Y-m-d');
                    } catch (\Exception $e) {
                        try {
                            // Coba format dengan dash
                            $tanggalLahir = Carbon::createFromFormat('d-m-Y', $cleanDate)->format('Y-m-d');
                        } catch (\Exception $ex) {
                            // Fallback terakhir: Biarkan Carbon menebak
                            $tanggalLahir = Carbon::parse($cleanDate)->format('Y-m-d');
                        }
                    }
                }
            } catch (\Exception $e) {
                // Jika error, biarkan null atau log errornya
                // \Log::error('Gagal parse tanggal: ' . $row['tanggal_lahir'] . ' - ' . $e->getMessage());
                $tanggalLahir = null;
            }
        }

        return new Penduduk([
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => strtoupper($row['jenis_kelamin']),
            'tempat_lahir' => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => $tanggalLahir,
            'status_keluarga' => strtolower($row['status_keluarga'] ?? ''),
            'alamat' => $row['alamat'] ?? null,
            'rt' => $row['rt'] ?? null,
            'rw' => $row['rw'] ?? null,
            'agama' => strtolower($row['agama'] ?? ''),
            'pekerjaan' => $row['pekerjaan'] ?? null,
            'status_perkawinan' => strtolower($row['status_perkawinan'] ?? ''),
            'disabilitas' => strtolower($row['disabilitas'] ?? 'tidak'),
            'keterangan_tambahan' => $row['keterangan_tambahan'] ?? null,
            'is_active' => true,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P,l,p,Laki-laki,Perempuan',
        ];
    }
}
