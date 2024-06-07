<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'mata_pelajaran';

    public function pengajars()
    {
        return $this->belongsToMany(User::class, 'guru_mata_pelajaran', 'mata_pelajaran_id', 'guru_id');
    }
    public function jurusans()
    {
        return $this->belongsToMany(Jurusan::class, 'jurusan_mata_pelajaran', 'mata_pelajaran_id', 'jurusan_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama_mapel', 'like', '%' . $search . '%');
            });
        });
    }
}
