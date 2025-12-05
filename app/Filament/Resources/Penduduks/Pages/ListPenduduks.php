<?php

namespace App\Filament\Resources\Penduduks\Pages;

use Filament\Actions\Action;
use App\Exports\PendudukExport;
use Filament\Actions\CreateAction;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Penduduks\PendudukResource;

class ListPenduduks extends ListRecords
{
    protected static string $resource = PendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Penduduk'),
            Action::make('Export')
                ->label('Export Excel')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    return Excel::download(
                        new PendudukExport(),
                        'data-penduduk-' . date('Y-m-d') . '.xlsx'
                    );
                }),
            Action::make('Import')
                ->label('Import Excel')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('primary')
                ->url(fn(): string => PendudukResource::getUrl('import')),
        ];
    }
}
