<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardMataPelajaran extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.admin.mapel.index', [
            'BanyakMapel' => MataPelajaran::filter(request(['search']))->orderBy('nama_mapel', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.mapel.create', [
            'BanyakGuru' => Guru::where('mapel', true)->get(),
            'BanyakJurusan' => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mapel' => 'required',
            'pengajars' => 'array|required',
            'pengajars.*' => 'exists:guru,user_id',
            'jurusans' => 'array|required',
            'jurusans.*' => 'exists:jurusan,id'
        ]);

        $mapel = MataPelajaran::create([
            'nama_mapel' => $validated['nama_mapel']
        ]);

        if ($request->has('pengajars')) {
            $pengajars = $request->input('pengajars');
            $mapel->pengajars()->attach($pengajars);
        }

        if ($request->has('jurusans')) {
            $jurusans = $request->input('jurusans');
            $mapel->jurusans()->attach($jurusans);
        }

        return redirect('/admin/mapel')->with([
            'success' => 'Berhasil Menambahkan Mata Pelajaran ',
            'nama' => $validated['nama_mapel']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mataPelajaran = MataPelajaran::where('id', $id)->first();
        return view('main.admin.mapel.edit', [
            'BanyakGuru' => Guru::where('mapel', true)->get(),
            'BanyakJurusan' => Jurusan::all(),
            'mapel' => $mataPelajaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mataPelajaran = MataPelajaran::where('id', $id)->first();

        $validated = $request->validate([
            'nama_mapel' => 'required',
            'pengajars' => 'array|required',
            'pengajars.*' => 'exists:guru,user_id',
            'jurusans' => 'array|required',
            'jurusans.*' => 'exists:jurusan,id'
        ]);

        $mataPelajaran->update([
            'nama_mapel' => $validated['nama_mapel']
        ]);

        if ($request->has('pengajars')) {
            $pengajars = $request->input('pengajars');
            $mataPelajaran->pengajars()->sync($pengajars);
        } else {
            $mataPelajaran->pengajars()->detach();
        }

        if ($request->has('jurusans')) {
            $jurusans = $request->input('jurusans');
            $mataPelajaran->jurusans()->sync($jurusans);
        } else {
            $mataPelajaran->jurusans()->detach();
        }

        return redirect('/admin/mapel')->with([
            'success' => 'Berhasil Mengedit Mata Pelajaran ',
            'nama' => $validated['nama_mapel']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = MataPelajaran::where('id', $id)->first();
        $userNama = $mapel->nama_mapel;
        $mapel->delete();
        return redirect('/admin/mapel')->with([
            'success' => 'Berhasil Menghapus Mata Pelajaran ',
            'nama' => $userNama
        ]);
    }
}
