<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use App\Imports\PendudukImport;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Maatwebsite\Excel\Facades\Excel;

class ImportPenduduk extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = PendudukResource::class;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.resources.penduduks.pages.import-penduduk';

    protected static ?string $title = 'Import Data Penduduk';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Upload File Excel')
                ->description('Upload file Excel (.xlsx atau .xls) yang berisi data penduduk')
                ->schema([
                    FileUpload::make('file')
                        ->label('File Excel')
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        // ->disk('public')
                        // ->directory('penduduk/import')
                        // ->visibility('public')
                        ->maxSize(5120)
                        ->required()
                        ->helperText('Format: .xlsx atau .xls | Max: 5MB')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Format File Excel')
                ->description('File Excel harus memiliki kolom-kolom berikut (baris pertama adalah header):')
                ->schema([
                    \Filament\Forms\Components\Placeholder::make('format_info')
                        ->label('')
                        ->content(view('filament.resources.penduduks.pages.import-guide'))
                        ->columnSpanFull(),
                ])
                ->collapsible(),
        ];
    }

    public function import(): void
    {
        $data = $this->form->getState();

        try {
            Excel::import(new PendudukImport, $data['file']);

            Notification::make()
                ->title('Berhasil!')
                ->body('Data penduduk berhasil diimport.')
                ->success()
                ->send();

            $this->redirect(PendudukResource::getUrl('index'));
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal!')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }
}
