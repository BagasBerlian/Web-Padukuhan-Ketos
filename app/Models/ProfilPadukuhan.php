<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPadukuhan extends Model
{
    use HasFactory;

    protected $table = 'profil_padukuhan';

    protected $fillable = [
        'visi',
        'misi',
        'foto_struktur',
        'luas_wilayah',
        'jumlah_rw',
        'jumlah_rt',
        'foto_kepala_padukuhan',
        'nama_kepala_padukuhan',
        'sambutan_kepala_padukuhan',
        'foto_tentang_padukuhan',
        'deskripsi_tentang_padukuhan',
        'updated_by',
    ];

    protected $casts = [
        'luas_wilayah' => 'decimal:2',
        'jumlah_rw' => 'integer',
        'jumlah_rt' => 'integer',
        'updated_at' => 'datetime',
    ];

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
