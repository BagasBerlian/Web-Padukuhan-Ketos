<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\Profil\ProfilCluster;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Pages\Page;
use BackedEnum;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Notifications\Notification;
use App\Models\ProfilPadukuhan as ProfilPadukuhanModel;

class ProfilPadukuhan extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Profil Padukuhan';

    protected static ?string $title = 'Profil Padukuhan';

    protected static ?string $cluster = ProfilCluster::class;

    protected string $view = 'filament.pages.profil-padukuhan';

    protected static ?int $navigationSort = 1;

    public ?array $data = [];

    public function mount(): void
    {
        $profil = ProfilPadukuhanModel::first();

        $this->form->fill([
            'visi' => $profil->visi ?? null,
            'misi' => $profil->misi ?? null,
            'foto_struktur' => $profil->foto_struktur ?? null,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Visi Padukuhan')
                ->description('Visi atau cita-cita padukuhan')
                ->schema([
                    RichEditor::make('visi')
                        ->label('')
                        ->placeholder('Masukkan visi padukuhan...')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ])
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-eye'),

            Section::make('Misi Padukuhan')
                ->description('Misi atau langkah-langkah untuk mencapai visi')
                ->schema([
                    RichEditor::make('misi')
                        ->label('')
                        ->placeholder('Masukkan misi padukuhan...')
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                        ])
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->icon('heroicon-o-document-text'),

            Section::make('Struktur Organisasi')
                ->description('Upload foto struktur organisasi pemerintahan padukuhan')
                ->schema([
                    FileUpload::make('foto_struktur')
                        ->label('Foto Struktur Organisasi')
                        ->image()
                        ->disk('public')
                        ->directory('struktur/padukuhan')
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
            $profil = ProfilPadukuhanModel::first();

            if ($profil) {
                $profil->update([
                    'visi' => $data['visi'],
                    'misi' => $data['misi'],
                    'foto_struktur' => $data['foto_struktur'],
                    'updated_by' => auth()->id(),
                ]);
            } else {
                ProfilPadukuhanModel::create([
                    'visi' => $data['visi'],
                    'misi' => $data['misi'],
                    'foto_struktur' => $data['foto_struktur'],
                    'updated_by' => auth()->id(),
                ]);
            }

            Notification::make()
                ->title('Berhasil!')
                ->body('Profil Padukuhan berhasil disimpan.')
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
