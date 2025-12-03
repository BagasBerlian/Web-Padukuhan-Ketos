<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Notifications\Notification;
use App\Models\SliderBeranda;
use App\Models\ProfilPadukuhan;

class Beranda extends Page
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Beranda';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.beranda';

    public ?array $data = [];
    public $sliders = [];

    public function mount(): void
    {
        $profil = ProfilPadukuhan::first();

        $sliders = SliderBeranda::orderBy('urutan')
            ->get()
            ->map(function ($slider) {
                return [
                    'id' => $slider->id,
                    'foto_path' => $slider->foto_path,
                    'urutan' => $slider->urutan,
                ];
            })
            ->toArray();

        $this->form->fill([
            'sliders' => $sliders,
            'luas_wilayah' => $profil->luas_wilayah ?? null,
            'jumlah_rw' => $profil->jumlah_rw ?? null,
            'jumlah_rt' => $profil->jumlah_rt ?? null,
            'foto_tentang_padukuhan' => $profil->foto_tentang_padukuhan ?? null,
            'foto_kepala_padukuhan' => $profil->foto_kepala_padukuhan ?? null,
            'nama_kepala_padukuhan' => $profil->nama_kepala_padukuhan ?? null,
            'sambutan_kepala_padukuhan' => $profil->sambutan_kepala_padukuhan ?? null,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Slider Beranda')
                ->description('Kelola foto slider maksimal 4 foto')
                ->schema([
                    Repeater::make('sliders')
                        ->schema([
                            FileUpload::make('foto_path')
                                ->label('Foto Slider')
                                ->image()
                                ->directory('slider')
                                ->disk('public')
                                ->visibility('public')
                                ->required()
                                ->maxSize(2048)
                                ->imageEditor()
                                ->imageResizeTargetWidth('1440')
                                ->imageResizeTargetHeight('500')
                                ->hint('Max: 2MB')
                                ->hintIcon('heroicon-m-information-circle')
                                ->columnSpanFull(),

                            TextInput::make('urutan')
                                ->label('Urutan')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])
                        ->columns(2)
                        ->maxItems(4)
                        ->minItems(0)
                        ->collapsible()
                        ->itemLabel(fn(array $state): ?string => 'Slider ' . ($state['urutan'] ?? 'Baru'))
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Slider')
                        ->reorderable()
                        ->deleteAction(
                            fn($action) => $action->requiresConfirmation()
                        )
                ])
                ->collapsible()
                ->id('slider'),

            Section::make('Informasi Singkat')
                ->description('Data wilayah padukuhan')
                ->schema([
                    TextInput::make('luas_wilayah')
                        ->label('Luas Wilayah (km²)')
                        ->numeric()
                        ->step(0.01)
                        ->suffix('km²')
                        ->required(),

                    TextInput::make('jumlah_rw')
                        ->label('Jumlah RW')
                        ->numeric()
                        ->required(),

                    TextInput::make('jumlah_rt')
                        ->label('Jumlah RT')
                        ->numeric()
                        ->required(),
                ])
                ->columns(3)
                ->collapsible(),

            Section::make('Tentang Padukuhan')
                ->description('Foto untuk section "Tentang Padukuhan"')
                ->schema([
                    FileUpload::make('foto_tentang_padukuhan')
                        ->label('Foto Tentang Padukuhan')
                        ->image()
                        ->directory('tentang')
                        ->disk('public')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->imageEditor()
                        ->imageResizeTargetWidth('1280')
                        ->imageResizeTargetHeight('650')
                        ->hint('Max: 2MB')
                        ->hintIcon('heroicon-m-information-circle')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Kepala Padukuhan')
                ->description('Informasi Kepala Padukuhan')
                ->schema([
                    FileUpload::make('foto_kepala_padukuhan')
                        ->label('Foto Kepala Padukuhan')
                        ->image()
                        ->directory('kepala-dukuh')
                        ->disk('public')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->imageEditor()
                        ->avatar()
                        ->imageResizeTargetWidth('500')
                        ->imageResizeTargetHeight('500')
                        ->panelAspectRatio('1:1')
                        ->columnSpanFull(),

                    TextInput::make('nama_kepala_padukuhan')
                        ->label('Nama Kepala Padukuhan')
                        ->required()
                        ->maxLength(100),

                    Textarea::make('sambutan_kepala_padukuhan')
                        ->label('Sambutan Kepala Padukuhan')
                        ->rows(5)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->collapsible(),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        try {
            $profil = ProfilPadukuhan::first();

            if ($profil) {
                $profil->update([
                    'luas_wilayah' => $data['luas_wilayah'],
                    'jumlah_rw' => $data['jumlah_rw'],
                    'jumlah_rt' => $data['jumlah_rt'],
                    'foto_tentang_padukuhan' => $data['foto_tentang_padukuhan'],
                    'foto_kepala_padukuhan' => $data['foto_kepala_padukuhan'],
                    'nama_kepala_padukuhan' => $data['nama_kepala_padukuhan'],
                    'sambutan_kepala_padukuhan' => $data['sambutan_kepala_padukuhan'],
                    'updated_by' => auth()->id(),
                ]);
            } else {
                ProfilPadukuhan::create([
                    'luas_wilayah' => $data['luas_wilayah'],
                    'jumlah_rw' => $data['jumlah_rw'],
                    'jumlah_rt' => $data['jumlah_rt'],
                    'foto_tentang_padukuhan' => $data['foto_tentang_padukuhan'],
                    'foto_kepala_padukuhan' => $data['foto_kepala_padukuhan'],
                    'nama_kepala_padukuhan' => $data['nama_kepala_padukuhan'],
                    'sambutan_kepala_padukuhan' => $data['sambutan_kepala_padukuhan'],
                    'updated_by' => auth()->id(),
                ]);
            }

            $existingIds = collect($data['sliders'] ?? [])->pluck('id')->filter();
            SliderBeranda::whereNotIn('id', $existingIds)->delete();

            foreach ($data['sliders'] ?? [] as $index => $sliderData) {
                if (isset($sliderData['id'])) {
                    SliderBeranda::find($sliderData['id'])->update([
                        'foto_path' => $sliderData['foto_path'],
                        'urutan' => $sliderData['urutan'] ?? $index,
                    ]);
                } else {
                    SliderBeranda::create([
                        'foto_path' => $sliderData['foto_path'],
                        'urutan' => $sliderData['urutan'] ?? $index,
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            Notification::make()
                ->title('Berhasil disimpan!')
                ->success()
                ->send();

            $this->mount();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
