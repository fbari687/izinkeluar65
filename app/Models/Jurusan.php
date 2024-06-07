<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    protected $guarded = ['id'];

    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'kaprodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'jurusan_id', 'id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'jurusan_id', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama_jurusan', 'like', '%' . $search . '%');
            });
        });
    }
}
