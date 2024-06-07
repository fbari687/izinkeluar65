<?php

namespace App\Http\Controllers;

use App\Http\Resources\GuruResource;
use App\Models\JadwalPelajaran;
use Carbon\Carbon;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardJadwalPelajaran extends Controller
{
    public function index()
    {
        return view('main.admin.jadwal.index', [
            'BanyakKelas' => Kelas::orderBy('tingkatan_kelas', 'asc')->get()
        ]);
    }

    public function detail(string $id)
    {
        $day = array_filter(Carbon::getDays(), function ($item) {
            return !in_array($item, ['Sunday', 'Saturday']);
        });

        $jadwalPelajaran = JadwalPelajaran::where('kelas_id', $id)->orderBy('jam_pelajaran', 'asc')->get();
        $sortedJadwalPelajaran = $jadwalPelajaran->sortBy(function ($item) {
            return [$item->hari, $item->jam_pelajaran];
        });
        return view('main.admin.jadwal.detail', [
            'kelas' => Kelas::where('id', $id)->first(),
            'BanyakJadwal' => $sortedJadwalPelajaran,
            'listHari' => $day
        ]);
    }

    public function edit(string $id, string $hari)
    {
        $mapel = 1;
        $jurusanKelas = Kelas::where('id', $id)->first()->jurusan_id;
        return view('main.admin.jadwal.edit', [
            'hari' => $hari,
            'kelas' => Kelas::where('id', $id)->first(),
            'BanyakJadwal' => JadwalPelajaran::where('kelas_id', $id)->where('hari', $hari)->get(),
            'BanyakMapel' => MataPelajaran::whereHas('jurusans', function ($query) use ($jurusanKelas) {
                $query->where('jurusan_id', $jurusanKelas);
            })->get(),
            'BanyakGuru' => User::whereHas('guru', function ($query) use ($mapel) {
                $query->where('mapel', $mapel);
            })->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_pelajaran_id.*' => 'required',
            'guru_id.*' => 'required',
        ]);

        for ($i = 1; $i <= 10; $i++) {
            JadwalPelajaran::updateOrCreate(
                [
                    'kelas_id' => $request->kelas_id,
                    'hari' => $request->hari,
                    'jam_pelajaran' => $i,
                ],
                [
                    'mata_pelajaran_id' => $request->mata_pelajaran_id[$i - 1],
                    'guru_id' => $request->guru_id[$i - 1],
                ]
            );
        }
        return redirect('/admin/jadwal/' . $request->input('kelas_id'))->with(['success' => 'Jadwal pelajaran berhasil disimpan']);
    }

    public function getGuru(Request $request)
    {
        $mataPelajaranId = (int)$request->query('uid');
        $guru = User::whereHas('mataPelajarans', function ($query) use ($mataPelajaranId) {
            $query->where('mata_pelajaran_id', $mataPelajaranId);
        })->get();
        return GuruResource::collection($guru);
        // return response()->json(['data' => $guru]);
    }
}
