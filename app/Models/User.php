<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\HasName;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function getFilamentName(): string
    {
        return (string) $this->nama_lengkap;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function sliderBeranda()
    {
        return $this->hasMany(SliderBeranda::class, 'created_by');
    }

    public function pendudukCreated()
    {
        return $this->hasMany(Penduduk::class, 'created_by');
    }

    public function umkmCreated()
    {
        return $this->hasMany(Umkm::class, 'created_by');
    }

    public function kegiatanCreated()
    {
        return $this->hasMany(Kegiatan::class, 'created_by');
    }

    public function pustakaWargaCreated()
    {
        return $this->hasMany(PustakaWarga::class, 'created_by');
    }

    public function pengaduanHandled()
    {
        return $this->hasMany(Pengaduan::class, 'ditangani_oleh');
    }
}
