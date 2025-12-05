<?php

namespace App\Filament\Resources\Penduduks\Tables;

use App\Models\Penduduk;
use Filament\Tables\Table;
use App\Exports\PendudukExport;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class PenduduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    })
                    ->sortable(),

                TextColumn::make('status_keluarga')
                    ->label('Status Keluarga')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'kepala keluarga' => 'success',
                        'istri' => 'info',
                        'anak' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn($state) => ucwords($state ?? '-'))
                    ->sortable(),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('rt')
                    ->label('RT')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('agama')
                    ->label('Agama')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => ucwords($state ?? '-'))
                    ->toggleable(),

                TextColumn::make('pekerjaan')
                    ->label('Pekerjaan')
                    ->searchable()
                    ->sortable()
                    ->limit(20)
                    ->placeholder('-')
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->native(false),

                SelectFilter::make('status_keluarga')
                    ->label('Status Keluarga')
                    ->options([
                        'kepala keluarga' => 'Kepala Keluarga',
                        'istri' => 'Istri',
                        'anak' => 'Anak',
                        'lainnya' => 'Lainnya',
                    ])
                    ->native(false),

                SelectFilter::make('agama')
                    ->label('Agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'Hindu',
                        'buddha' => 'Buddha',
                        'konghucu' => 'Konghucu',
                    ])
                    ->native(false),

                SelectFilter::make('rt')
                    ->label('RT')
                    ->options(function () {
                        return Penduduk::query()
                            ->whereNotNull('rt')
                            ->where('rt', '!=', '')
                            ->distinct()
                            ->pluck('rt', 'rt')
                            ->sort();
                    })
                    ->searchable()
                    ->native(false),

                SelectFilter::make('rw')
                    ->label('RW')
                    ->options(function () {
                        return Penduduk::query()
                            ->whereNotNull('rw')
                            ->where('rw', '!=', '')
                            ->distinct()
                            ->pluck('rw', 'rw')
                            ->sort();
                    })
                    ->searchable()
                    ->native(false),

                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->native(false),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Detail'),
                EditAction::make()
                    ->label('Ubah'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus yang dipilih'),
                    BulkAction::make('export_selected')
                        ->label('Export Terpilih')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            return Excel::download(
                                new PendudukExport($records),
                                'data-penduduk-terpilih-' . date('Y-m-d') . '.xlsx'
                            );
                        })
                        ->deselectRecordsAfterCompletion(),
                ])
                    ->label('Aksi Tambahan'),
            ])
            ->emptyStateHeading('Belum ada data penduduk')
            ->emptyStateDescription('Silakan tambah data penduduk dengan klik tombol "Tambah Penduduk" di atas.')
            ->emptyStateIcon('heroicon-o-users');
    }
}
