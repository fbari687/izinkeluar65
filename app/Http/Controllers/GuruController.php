<?php

namespace App\Http\Controllers;

use App\Models\PerizinanGuru;
use App\Models\PerizinanSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function home()
    {
        $idGuru = auth()->user()->id;
        $perizinanSiswa = PerizinanSiswa::where('status_perizinan_id', 1)->whereHas('perizinanGuru', function ($query) use ($idGuru) {
            $query->where('guru_id', $idGuru)
                ->where('status_perizinan_id', 1);
        })->orderBy('id', 'desc')->get();
        return view('main.guru.home', [
            'PerizinanSiswas' => $perizinanSiswa
        ]);
    }

    public function detailIzin(string $id)
    {
        $tanggalHariIni = Carbon::today()->format('Y-m-d');
        $perizinanSiswa = PerizinanSiswa::where('siswa_id', $id)->where('status_perizinan_id', 1)->first();
        $perizinanSiswaId = $perizinanSiswa->id;
        $day = Carbon::parse($perizinanSiswa->tanggal)->format('l');
        $perizinanGurus = PerizinanGuru::whereHas('perizinanSiswa', function ($query) use ($perizinanSiswaId) {
            $query->where('perizinan_siswa_id', $perizinanSiswaId)
                ->where('guru_id', auth()->user()->id);
        })->get();
        return view('main.guru.detailIzin', [
            'perizinanSiswa' => $perizinanSiswa,
            'perizinanGurus' => $perizinanGurus,
            'day' => $day
        ]);
    }

    public function givePermission(Request $request, string $id)
    {
        for ($i = 0; $i < count($request->input('keterangan_perizinan_id')); $i++) {
            $perizinanGuru = PerizinanGuru::where('perizinan_siswa_id', $id)->where('keterangan_perizinan_id', $request->keterangan_perizinan_id[$i])->first();

            $perizinanGuru->update([
                'status_perizinan_id' => 3
            ]);
        }
        $semuaStatus3 = PerizinanGuru::where('perizinan_siswa_id', $id)
            ->where('status_perizinan_id', '<>', 3) // Mengambil yang status bukan 3
            ->doesntExist();

        // Jika semua status 3, update status pada PerizinanSiswa
        if ($semuaStatus3) {
            PerizinanSiswa::where('id', $id)->update([
                'status_perizinan_id' => 3
            ]);
        }

        return redirect('/guru')->with([
            'success' => 'Berhasi Memberi Izin Keluar'
        ]);
    }

    public function riwayat()
    {
        $user_id = auth()->user()->id;
        $perizinanSiswa = PerizinanSiswa::whereHas('perizinanGuru', function ($query) use ($user_id) {
            $query->where('guru_id', $user_id)
                ->where('status_perizinan_id', 3);
        })->get();
        return view('main.guru.riwayat', [
            'banyakPerizinanSiswa' => $perizinanSiswa
        ]);
    }

    public function detailRiwayat(string $id)
    {
        $perizinanSiswa = PerizinanSiswa::where('id', $id)->first();
        $today = Carbon::parse($perizinanSiswa->tanggal)->format('l');
        return view('main.guru.detail', [
            'perizinanSiswa' => $perizinanSiswa,
            'day' => $today
        ]);
    }
}
