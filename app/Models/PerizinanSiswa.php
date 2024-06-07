<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanSiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'perizinan_siswa';

    public function siswa()
    {
        return $this->belongsTo(User::class);
    }

    public function statusPerizinan()
    {
        return $this->belongsTo(StatusPerizinan::class);
    }

    public function perizinanGuru()
    {
        return $this->hasMany(PerizinanGuru::class, 'perizinan_siswa_id', 'id');
    }
}
