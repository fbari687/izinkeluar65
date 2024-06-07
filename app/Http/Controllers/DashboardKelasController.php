<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;

class DashboardKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.admin.kelas.index', [
            'BanyakKelas' => Kelas::filter(request(['search']))->orderBy('tingkatan_kelas', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.kelas.create', [
            'BanyakGuru' => Guru::where('wali_kelas', true)->get(),
            'BanyakJurusan' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tingkatan_kelas' => 'required|numeric',
            'wali_kelas_id' => 'required|exists:users,id'
        ]);

        Kelas::create($validated);

        return redirect('/admin/kelas')->with([
            'success' => 'Berhasil Menambah Kelas ',
            'nama' => $validated['nama_kelas']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('main.admin.kelas.edit', [
            'BanyakGuru' => Guru::where('wali_kelas', true)->get(),
            'BanyakJurusan' => Jurusan::all(),
            'kelas' => Kelas::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::where('id', $id)->first();

        $validated = $request->validate([
            'nama_kelas' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'tingkatan_kelas' => 'required|numeric',
            'wali_kelas_id' => 'required|exists:users,id'
        ]);

        $kelas->update($validated);

        return redirect('/admin/kelas')->with([
            'success' => 'Berhasil Mengubah Kelas ',
            'nama' => $validated['nama_kelas']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::where('id', $id)->first();
        $userNama = $kelas->nama_kelas;
        $check = $kelas->siswa->isEmpty();
        if ($check) {
            $kelasDelete = $kelas->delete();
            if ($kelasDelete) {
                return redirect('/admin/kelas')->with([
                    'success' => 'Berhasil Menghapus Kelas ',
                    'nama' => $userNama
                ]);
            }
        }
        return redirect('/admin/kelas')->with([
            'failed' => 'Gagal Menghapus Kelas ',
            'nama' => $userNama
        ]);
    }
}
