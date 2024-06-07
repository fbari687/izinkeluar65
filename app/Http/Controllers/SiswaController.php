<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\PerizinanGuru;
use App\Models\PerizinanSiswa;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function profile()
    {
        return view('main.siswa.profile', [
            'siswa' => Siswa::where('user_id', auth()->user()->id)->first()
        ]);
    }

    public function formPerizinan()
    {
        $hariIni = Carbon::today()->format('l');
        $tanggalSekarang = Carbon::today()->format('Y-m-d');
        $siswa = Siswa::where('user_id', auth()->user()->id)->first();
        return view('main.siswa.form', [
            'siswa' => $siswa,
            'BanyakJadwal' => JadwalPelajaran::where('kelas_id', $siswa->kelas_id)->where('hari', $hariIni)->orderBy('jam_pelajaran', 'asc')->get(),
            'BanyakGuruPiket' => Guru::where('piket', true)->get(),
            'today' => $hariIni,
            'tanggalSekarang' => $tanggalSekarang,
        ]);
    }

    public function detail(string $id)
    {
        $perizinanSiswa = PerizinanSiswa::where('id', $id)->first();
        $today = Carbon::parse($perizinanSiswa->tanggal)->format('l');
        return view('main.siswa.detail', [
            'perizinanSiswa' => $perizinanSiswa,
            'day' => $today
        ]);
    }

    public function riwayat()
    {
        $user = auth()->user()->id;
        $perizinanSiswa = PerizinanSiswa::where('siswa_id', $user)->orderBy('id', 'desc')->get();
        return view('main.siswa.riwayat', [
            'banyakPerizinanSiswa' => $perizinanSiswa
        ]);
    }
}
