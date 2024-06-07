<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.admin.jurusan.index', [
            'BanyakJurusan' => Jurusan::filter(request(['search']))->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.jurusan.create', [
            'BanyakGuru' => Guru::where('kaprodi', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required',
            'kaprodi_id' => 'required|exists:users,id'
        ]);

        Jurusan::create($validated);

        return redirect('/admin/jurusan')->with([
            'success' => 'Berhasil Menambah Jurusan ',
            'nama' => $validated['nama_jurusan']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('main.admin.jurusan.edit', [
            'BanyakGuru' => Guru::where('kaprodi', 1)->get(),
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required',
            'kaprodi_id' => 'required|exists:users,id'
        ]);

        $jurusan->update($validated);

        return redirect('/admin/jurusan')->with([
            'success' => 'Berhasil Mengubah Jurusan ',
            'nama' => $validated['nama_jurusan']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $namajurusan = $jurusan->nama_jurusan;
        $checkKelas = $jurusan->kelas->isEmpty();
        $checkSiswa = $jurusan->siswa->isEmpty();
        if ($checkKelas && $checkSiswa) {
            $jurusanDelete = $jurusan->delete();
            if ($jurusanDelete) {
                return redirect('/admin/jurusan')->with([
                    'success' => 'Berhasil Menghapus Jurusan ',
                    'nama' => $namajurusan
                ]);
            }
        }
        return redirect('/admin/jurusan')->with([
            'failed' => 'Gagal Menghapus Jurusan ',
            'nama' => $namajurusan
        ]);
    }
}
