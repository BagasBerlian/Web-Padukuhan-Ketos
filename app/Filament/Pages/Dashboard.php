<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Ringkasan';

    protected static ?string $title = 'Informasi Singkat Padukuhan Ketos';

    protected static ?int $navigationSort = 1;

    protected static string | BackedEnum | null $navigationIcon =  'heroicon-o-chart-bar';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\RingkasanStatsWidget::class,
        ];
    }
}
