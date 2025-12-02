<?php

namespace App\Filament\Widgets;

use App\Models\Penduduk;
use App\Models\Umkm;
use App\Models\Kegiatan;
use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RingkasanStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Penduduk', Penduduk::where('is_active', true)->count())
                ->description('Jumlah seluruh penduduk aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Jumlah KK', Penduduk::where('status_keluarga', 'kepala keluarga')
                ->where('is_active', true)
                ->count())
                ->description('Jumlah Kepala Keluarga')
                ->descriptionIcon('heroicon-m-home')
                ->color('primary'),

            Stat::make('Total UMKM', Umkm::where('is_active', true)->count())
                ->description('UMKM terdaftar')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('warning'),

            Stat::make('Kegiatan Bulan Ini', Kegiatan::whereMonth('tanggal_kegiatan', now()->month)
                ->whereYear('tanggal_kegiatan', now()->year)
                ->count())
                ->description('Kegiatan di ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Pengaduan Pending', Pengaduan::where('status', 'pending')->count())
                ->description('Menunggu penanganan')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
