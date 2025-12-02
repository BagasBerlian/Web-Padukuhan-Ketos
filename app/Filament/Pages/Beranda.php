<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use BackedEnum;

class Beranda extends Page
{
    // protected string $view = 'filament.pages.beranda';
    protected static ?string $navigationLabel = 'Beranda';

    protected static ?string $title = 'Beranda';

    protected static ?int $navigationSort = 2;

    protected static string | BackedEnum | null $navigationIcon =  'heroicon-o-home';
}
