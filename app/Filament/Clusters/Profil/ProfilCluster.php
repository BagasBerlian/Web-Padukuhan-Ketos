<?php

namespace App\Filament\Clusters\Profil;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;

class ProfilCluster extends Cluster
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Profil';

    protected static ?int $navigationSort = 3;
}
