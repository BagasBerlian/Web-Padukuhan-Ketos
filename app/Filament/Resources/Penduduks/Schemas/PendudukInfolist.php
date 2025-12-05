<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;

class PendudukInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pribadi')
                    ->schema([
                        TextEntry::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->size('lg')
                            ->weight('bold')
                            ->columnSpanFull(),

                        TextEntry::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'L' => 'info',
                                'P' => 'warning',
                            })
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            }),

                        TextEntry::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->placeholder('-'),

                        TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->date('d F Y')
                            ->placeholder('-'),

                        TextEntry::make('umur')
                            ->label('Umur')
                            ->state(function ($record) {
                                return $record->tanggal_lahir
                                    ? $record->tanggal_lahir->age . ' tahun'
                                    : '-';
                            })
                            ->badge()
                            ->color('primary'),

                        TextEntry::make('status_keluarga')
                            ->label('Status Keluarga')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'kepala keluarga' => 'success',
                                'istri' => 'info',
                                'anak' => 'warning',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn($state) => ucwords($state ?? '-')),
                    ])
                    ->columns(2),

                Section::make('Alamat')
                    ->schema([
                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        TextEntry::make('rt')
                            ->label('RT')
                            ->placeholder('-'),

                        TextEntry::make('rw')
                            ->label('RW')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Data Lainnya')
                    ->schema([
                        TextEntry::make('agama')
                            ->label('Agama')
                            ->badge()
                            ->color('info')
                            ->formatStateUsing(fn($state) => ucwords($state ?? '-')),

                        TextEntry::make('pekerjaan')
                            ->label('Pekerjaan')
                            ->placeholder('-'),

                        TextEntry::make('status_perkawinan')
                            ->label('Status Perkawinan')
                            ->formatStateUsing(fn($state) => ucwords($state ?? '-')),

                        TextEntry::make('disabilitas')
                            ->label('Disabilitas')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'tidak ada' => 'gray',
                                default => 'warning',
                            })
                            ->formatStateUsing(fn($state) => ucwords($state ?? 'Tidak')),
                    ])
                    ->columns(2),

                Section::make('Keterangan Tambahan')
                    ->schema([
                        TextEntry::make('keterangan_tambahan')
                            ->label('Keterangan')
                            ->placeholder('Tidak ada keterangan')
                            ->columnSpanFull(),
                    ])
                    ->hidden(fn($record) => empty($record->keterangan_tambahan)),

                Section::make('Informasi Sistem')
                    ->schema([
                        IconEntry::make('is_active')
                            ->label('Status Aktif')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),

                        TextEntry::make('creator.nama_lengkap')
                            ->label('Dibuat Oleh')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d F Y, H:i')
                            ->placeholder('-'),

                        TextEntry::make('updater.nama_lengkap')
                            ->label('Diupdate Oleh')
                            ->placeholder('-'),

                        TextEntry::make('updated_at')
                            ->label('Diupdate Pada')
                            ->dateTime('d F Y, H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
