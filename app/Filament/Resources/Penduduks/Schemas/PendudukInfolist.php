<?php

namespace App\Filament\Resources\Penduduks\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PendudukInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_lengkap'),
                TextEntry::make('jenis_kelamin'),
                TextEntry::make('tempat_lahir')
                    ->placeholder('-'),
                TextEntry::make('tanggal_lahir')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status_keluarga')
                    ->placeholder('-'),
                TextEntry::make('alamat')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('rt')
                    ->placeholder('-'),
                TextEntry::make('rw')
                    ->placeholder('-'),
                TextEntry::make('agama')
                    ->placeholder('-'),
                TextEntry::make('pekerjaan')
                    ->placeholder('-'),
                TextEntry::make('status_perkawinan')
                    ->placeholder('-'),
                TextEntry::make('disabilitas')
                    ->placeholder('-'),
                TextEntry::make('keterangan_tambahan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('updated_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
