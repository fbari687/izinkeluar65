<?php

namespace App\Http\Controllers;

use App\Models\PerizinanGuru;
use Carbon\Carbon;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\PerizinanSiswa;

class HomeController extends Controller
{
    public function siswa()
    {
        $hariIni = Carbon::today()->format('l');
        $tanggalSekarang = Carbon::today()->format('Y-m-d');
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        $perizinanSiswas = PerizinanSiswa::where('siswa_id', $siswa->user_id)->where('tanggal', $tanggalSekarang)->get();
        $perizinanGurus = PerizinanGuru::whereIn('perizinan_siswa_id', $perizinanSiswas->pluck('id'))->get();
        return view('main.siswa.home', [
            'perizinans' => $perizinanSiswas,
            'perizinanGurus' => $perizinanGurus,
            'siswa' => $siswa
        ]);
    }
}
