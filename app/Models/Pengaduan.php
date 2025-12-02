<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'rt',
        'isi_pengaduan',
        'kategori',
        'status',
        'tanggapan',
        'ditangani_oleh',
        'tanggal_pengaduan',
        'tanggal_tanggapan',
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'datetime',
        'tanggal_tanggapan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function handler()
    {
        return $this->belongsTo(User::class, 'ditangani_oleh');
    }
}
