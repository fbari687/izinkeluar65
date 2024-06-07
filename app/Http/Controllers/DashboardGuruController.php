<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::where('role_id', 2)->first();
        // dd($user->guru);
        return view('main.admin.guru.index', [
            'BanyakGuru' => User::filter(request(['search']))->where('role_id', 2)->orderBy('id', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.admin.guru.create');
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

        $guru = [
            'wali_kelas' => (int) $request->input('wali_kelas'),
            'piket' => (int) $request->input('piket'),
            'mapel' => (int) $request->input('mapel'),
            'kaprodi' => (int) $request->input('kaprodi'),
        ];

        $validated['password'] = bcrypt($validated['password']);
        $validated['nama'] = ucwords($validated['nama']);
        $validated['role_id'] = 2;

        $user = User::create($validated);

        $guru['user_id'] = $user->id;
        Guru::create($guru);


        return redirect('/admin/guru')->with([
            'success' => 'Menambahkan Guru ',
            'nama' => $validated['nama']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        return view('main.admin.guru.edit', [
            'guru' => Guru::where('user_id', $id)->first()
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

        $guruRules = [
            'wali_kelas' => (int) $request->input('wali_kelas'),
            'piket' => (int) $request->input('piket'),
            'mapel' => (int) $request->input('mapel'),
            'kaprodi' => (int) $request->input('kaprodi'),
        ];

        $userChanged = $user->update($validated);

        $guru = Guru::where('user_id', $id)->first();
        $guruChanged = $guru->update($guruRules);

        return redirect('/admin/guru')->with([
            'success' => 'Mengedit Guru ',
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
        $checkKaprodi = $user->kaprodi;
        $checkMatapelajarans = $user->mataPelajarans->isEmpty();
        $checkWalikelas = $user->walikelas;
        if (!$checkKaprodi && $checkMatapelajarans && !$checkWalikelas) {
            $user->delete();
            return redirect('/admin/guru')->with([
                'success' => 'Berhasil Menghapus Guru ',
                'nama' => $userNama
            ]);
        }
        return redirect('/admin/guru')->with([
            'failed' => 'Gagal Menghapus Guru ',
            'nama' => $userNama
        ]);
    }
}
