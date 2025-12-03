<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Icons\Heroicon;

class PendudukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_lengkap')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                TextInput::make('tempat_lahir'),
                DatePicker::make('tanggal_lahir'),
                Select::make('status_keluarga')
                    ->label('Status Keluarga')
                    ->options([
                        'kepala keluarga' => 'Kepala Keluarga',
                        'istri' => 'Istri',
                        'anak' => 'Anak',
                        'lainnya' => 'Lainnya'
                    ]),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('rt'),
                TextInput::make('rw'),
                Select::make('agama')
                    ->label('Agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'Hindu',
                        'buddha' => 'Buddha',
                        'konghucu' => 'Konghucu',
                        'lainnya' => 'Lainnya'
                    ]),
                TextInput::make('pekerjaan'),
                Select::make('status_perkawinan')
                    ->label('Status Perkawinan')
                    ->options([
                        'belum kawin' => 'Belum Kawin',
                        'kawin' => 'Kawin',
                        'cerai hidup' => 'Cerai Hidup',
                        'cerai mati' => 'Cerai Mati'
                    ]),
                TextInput::make('disabilitas'),
                Textarea::make('keterangan_tambahan')
                    ->hint('Isi jika Penduduk tidak aktif')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Apakah penduduk masih aktif tinggal di Ketos?')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon(Heroicon::Check)
                    ->offIcon(Heroicon::XMark)
                    ->inline(false)
                    ->required(),
            ]);
    }
}
