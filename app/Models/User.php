<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $table = 'users';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function guru(): HasOne
    {
        return $this->hasOne(Guru::class, 'user_id', 'id');
    }

    public function detailSiswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    public function mataPelajarans()
    {
        return $this->belongsToMany(MataPelajaran::class, 'guru_mata_pelajaran', 'guru_id', 'mata_pelajaran_id');
    }

    public function jadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'guru_id', 'id');
    }

    public function kaprodi()
    {
        return $this->hasOne(Jurusan::class, 'kaprodi_id', 'id');
    }

    public function walikelas()
    {
        return $this->hasOne(Kelas::class, 'wali_kelas_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });
    }
}
