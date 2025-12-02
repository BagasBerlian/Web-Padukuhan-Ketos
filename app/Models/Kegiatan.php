<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'foto_kegiatan',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'deskripsi_kegiatan',
        'lokasi',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
