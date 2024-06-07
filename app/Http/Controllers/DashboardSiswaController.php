<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main.admin.siswa.index', [
            // 'BanyakSiswa' => Siswa::orderBy('nisInteger', 'asc')->get(),
            // 'BanyakSiswa' => Siswa::orderBy('nisInteger', 'asc')->paginate(1)->withQueryString(),
            'BanyakSiswa' => Siswa::filter(request(['search']))->orderBy('nisInteger', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.siswa.create', [
            'BanyakKelas' => Kelas::orderBy('tingkatan_kelas', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required'
        ]);

        $credentials = $request->validate([
            'nis' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['nama'] = ucwords(strtolower($validated['nama']));
        $validated['role_id'] = 3;

        $user = User::create($validated);

        $credentials['user_id'] = $user->id;
        $credentials['nisInteger'] = (int) ltrim($credentials['nis'], '0');
        $credentials['jurusan_id'] = Kelas::where('id', $credentials['kelas_id'])->first()->jurusan_id;
        Siswa::create($credentials);

        return redirect('/admin/siswa')->with([
            'success' => 'Menambahkan Siswa ',
            'nama' => $validated['nama']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('main.admin.siswa.edit', [
            'BanyakKelas' => Kelas::orderBy('tingkatan_kelas', 'desc')->get(),
            'siswa' => Siswa::where('user_id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();

        $rules = [
            'nama' => 'required',
        ];

        if ($request->input('username') != $user->username) {
            $rules['username'] = 'unique:users,username|required';
        }

        $validated = $request->validate($rules);

        $credentials = $request->validate([
            'nis' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $validated['nama'] = ucwords(strtolower($validated['nama']));
        $validated['role_id'] = 3;

        $userChanged = $user->update($validated);

        $siswa = Siswa::where('user_id', $id)->first();

        $credentials['user_id'] = $user->id;
        $credentials['nisInteger'] = (int) ltrim($credentials['nis'], '0');
        $credentials['jurusan_id'] = Kelas::where('id', $credentials['kelas_id'])->first()->jurusan_id;
        $siswaChanged = $siswa->update($credentials);

        return redirect('/admin/siswa')->with([
            'success' => 'Mengedit Siswa ',
            'nama' => $validated['nama']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();
        $userNama = $user->nama;
        if ($user->profile_picture != 'user-image/unknown.png') {
            Storage::delete($user->profile_picture);
        }
        $user->delete();
        return redirect('/admin/siswa')->with([
            'success' => 'Berhasil Menghapus Siswa ',
            'nama' => $userNama
        ]);
    }
}
