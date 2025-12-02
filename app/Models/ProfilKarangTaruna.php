<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilKarangTaruna extends Model
{
    use HasFactory;

    protected $table = 'profil_karang_taruna';

    protected $fillable = [
        'foto_ketua',
        'nama_ketua',
        'sambutan_ketua',
        'visi',
        'misi',
        'foto_struktur',
        'updated_by',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
