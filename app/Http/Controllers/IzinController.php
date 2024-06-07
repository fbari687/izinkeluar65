<?php

namespace App\Http\Controllers;

use App\Models\PerizinanGuru;
use App\Models\PerizinanSiswa;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function store(Request $request)
    {
        $status_perizinan_id = 1;
        $request->validate([
            'keterangan_perizinan_id.*' => 'required|exists:keterangan_perizinan,id',
            'guru_id.*' => 'required|exists:users,id',
        ]);
        $validated = $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'alasan' => 'required',
            'tanggal' => 'date'
        ]);
        $validated['status_perizinan_id'] = $status_perizinan_id;

        $perizinanSiswa = PerizinanSiswa::create($validated);

        for ($i = 0; $i < count($request->input('guru_id')); $i++) {
            PerizinanGuru::create([
                'perizinan_siswa_id' => $perizinanSiswa->id,
                'guru_id' => $request->guru_id[$i],
                'status_perizinan_id' => $status_perizinan_id,
                'keterangan_perizinan_id' => $request->keterangan_perizinan_id[$i]
            ]);
        }
        return redirect('/siswa')->with([
            'success' => 'Berhasil Mengajukan Izin Keluar '
        ]);
    }
}
