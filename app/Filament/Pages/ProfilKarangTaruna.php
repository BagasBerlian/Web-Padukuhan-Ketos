<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Profil\ProfilCluster;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Grid;
use Filament\Notifications\Notification;
use App\Models\ProfilKarangTaruna as ProfilKarangTarunaModel;

class ProfilKarangTaruna extends Page
{
    use InteractsWithForms;

    protected static ?string $cluster = ProfilCluster::class;

    protected static ?string $navigationLabel = 'Profil Karang Taruna';

    protected static ?string $title = 'Profil Karang Taruna';

    protected string $view = 'filament.pages.profil-karang-taruna';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $profil = ProfilKarangTarunaModel::first();

        $this->form->fill([
            'foto_ketua' => $profil->foto_ketua ?? null,
            'nama_ketua' => $profil->nama_ketua ?? null,
            'sambutan_ketua' => $profil->sambutan_ketua ?? null,
            'visi' => $profil->visi ?? null,
            'misi' => $profil->misi ?? null,
            'foto_struktur' => $profil->foto_struktur ?? null,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Informasi Ketua')
                ->description('Data ketua Karang Taruna')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            FileUpload::make('foto_ketua')
                                ->label('Foto Ketua')
                                ->image()
                                ->disk('public')
                                ->directory('karang-taruna/ketua')
                                ->visibility('public')
                                ->maxSize(2048)
                                ->imageEditor()
                                ->avatar()
                                ->imagePreviewHeight('200')
                                ->imageResizeTargetWidth('500')
                                ->imageResizeTargetHeight('500')
                                ->columnSpan(1)
                                ->alignCenter(),

                            Grid::make(1)
                                ->schema([
                                    TextInput::make('nama_ketua')
                                        ->label('Nama Ketua')
                                        ->placeholder('Masukkan nama ketua Karang Taruna')
                                        ->required()
                                        ->maxLength(100),

                                    Textarea::make('sambutan_ketua')
                                        ->label('Sambutan Ketua')
                                        ->placeholder('Masukkan sambutan dari ketua Karang Taruna...')
                                        ->rows(4)
                                        ->maxLength(500),
                                ])
                                ->columnSpan(1),
                        ]),
                ])
                ->collapsible()
                ->icon('heroicon-o-user-circle'),

            Section::make('Visi Karang Taruna')
                ->description('Visi atau cita-cita Karang Taruna')
                ->schema([
                    RichEditor::make('visi')
                        ->label('')
                        ->placeholder('Masukkan visi Karang Taruna...')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ])
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-eye'),

            Section::make('Misi Karang Taruna')
                ->description('Misi atau program kerja Karang Taruna')
                ->schema([
                    RichEditor::make('misi')
                        ->label('')
                        ->placeholder('Masukkan misi Karang Taruna...')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ])
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-document-text'),

            Section::make('Struktur Organisasi')
                ->description('Upload foto struktur organisasi Karang Taruna')
                ->schema([
                    FileUpload::make('foto_struktur')
                        ->label('Foto Struktur Organisasi')
                        ->image()
                        ->disk('public')
                        ->directory('struktur/karang-taruna')
                        ->visibility('public')
                        ->maxSize(3072)
                        ->imageEditor()
                        ->imagePreviewHeight('400')
                        ->panelLayout('integrated')
                        ->hint('Format: JPG, PNG | Max: 3MB')
                        ->hintIcon('heroicon-m-information-circle')
                        ->imageResizeTargetWidth('1270')
                        ->imageResizeTargetHeight('900')
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-building-office'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        try {
            $profil = ProfilKarangTarunaModel::first();

            if ($profil) {
                $profil->update([
                    'foto_ketua' => $data['foto_ketua'],
                    'nama_ketua' => $data['nama_ketua'],
                    'sambutan_ketua' => $data['sambutan_ketua'],
                    'visi' => $data['visi'],
                    'misi' => $data['misi'],
                    'foto_struktur' => $data['foto_struktur'],
                    'updated_by' => auth()->id(),
                ]);
            } else {
                ProfilKarangTarunaModel::create([
                    'foto_ketua' => $data['foto_ketua'],
                    'nama_ketua' => $data['nama_ketua'],
                    'sambutan_ketua' => $data['sambutan_ketua'],
                    'visi' => $data['visi'],
                    'misi' => $data['misi'],
                    'foto_struktur' => $data['foto_struktur'],
                    'updated_by' => auth()->id(),
                ]);
            }

            Notification::make()
                ->title('Berhasil!')
                ->body('Profil Karang Taruna berhasil disimpan.')
                ->success()
                ->send();

            $this->mount();
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
