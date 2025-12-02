<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PustakaWarga extends Model
{
    use HasFactory;

    protected $table = 'pustaka_warga';

    protected $fillable = [
        'foto_cover',
        'nama_dokumen',
        'pemilik',
        'tanggal_publikasi',
        'deskripsi',
        'link_dokumen',
        'link_video',
        'tipe_informasi',
        'is_published',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'date',
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
