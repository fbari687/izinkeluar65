<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanGuru extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'perizinan_guru';

    public function perizinanSiswa()
    {
        return $this->belongsTo(PerizinanSiswa::class, 'perizinan_siswa_id');
    }

    public function keteranganPerizinan()
    {
        return $this->belongsTo(KeteranganPerizinan::class, 'keterangan_perizinan_id', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id', 'id');
    }

    public function statusPerizinan()
    {
        return $this->belongsTo(StatusPerizinan::class);
    }
}
