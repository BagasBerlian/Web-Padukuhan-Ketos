<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use BackedEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class PendudukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pribadi')
                    ->description('Informasi pribadi penduduk')
                    ->schema([
                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Masukkan nama lengkap')
                            ->columnSpanFull(),

                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->maxLength(50)
                            ->placeholder('Kota/Kabupaten'),

                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->maxDate(now())
                            ->placeholder('Pilih tanggal'),

                        Select::make('status_keluarga')
                            ->label('Status Keluarga')
                            ->options([
                                'kepala keluarga' => 'Kepala Keluarga',
                                'istri' => 'Istri',
                                'anak' => 'Anak',
                                'lainnya' => 'Lainnya'
                            ])
                            ->native(false)
                            ->placeholder('Pilih status keluarga'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Alamat')
                    ->description('Informasi tempat tinggal')
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->placeholder('Masukkan alamat lengkap')
                            ->columnSpanFull(),

                        TextInput::make('rt')
                            ->label('RT')
                            ->maxLength(10)
                            ->placeholder('001'),

                        TextInput::make('rw')
                            ->label('RW')
                            ->maxLength(10)
                            ->placeholder('001'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Data Lainnya')
                    ->description('Informasi tambahan penduduk')
                    ->schema([
                        Select::make('agama')
                            ->label('Agama')
                            ->options([
                                'islam' => 'Islam',
                                'kristen' => 'Kristen',
                                'katolik' => 'Katolik',
                                'hindu' => 'Hindu',
                                'buddha' => 'Buddha',
                                'konghucu' => 'Konghucu',
                            ])
                            ->native(false)
                            ->placeholder('Pilih agama'),

                        TextInput::make('pekerjaan')
                            ->label('Pekerjaan')
                            ->maxLength(50)
                            ->placeholder('Pekerjaan saat ini'),

                        Select::make('status_perkawinan')
                            ->label('Status Perkawinan')
                            ->options([
                                'belum kawin' => 'Belum Kawin',
                                'kawin' => 'Kawin',
                                'cerai hidup' => 'Cerai Hidup',
                                'cerai mati' => 'Cerai Mati'
                            ])
                            ->native(false)
                            ->placeholder('Pilih status perkawinan'),

                        Select::make('disabilitas')
                            ->label('Disabilitas')
                            ->options([
                                'tidak ada' => 'Tidak Ada',
                                'fisik' => 'Fisik',
                                'mental' => 'Mental',
                                'fisik dan mental' => 'Fisik dan Mental',
                            ])
                            ->native(false)
                            ->default('tidak')
                            ->placeholder('Pilih jenis disabilitas'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Keterangan & Status')
                    ->schema([
                        Textarea::make('keterangan_tambahan')
                            ->label('Keterangan Tambahan')
                            ->rows(3)
                            ->placeholder('Keterangan tambahan (jika ada)')
                            ->hint('Isi jika penduduk sudah pindah/meninggal')
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Non-aktifkan jika penduduk sudah pindah atau meninggal')
                            ->onColor('success')
                            ->offColor('danger')
                            ->onIcon(Heroicon::Check)
                            ->offIcon(Heroicon::XMark)
                            ->inline(false)
                            ->default(true)
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }
}
