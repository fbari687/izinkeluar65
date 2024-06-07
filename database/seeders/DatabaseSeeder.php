<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admins;
use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            StatusSeeder::class,
            KeteranganPerizinanSeeder::class
        );

        $listRoles = ['Admin', 'Guru', 'Siswa'];

        foreach ($listRoles as $role) {
            Role::create([
                'nama' => $role
            ]);
        }

        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin65'),
            'role_id' => 1
        ]);

        Admins::create([
            'user_id' => 1
        ]);

        User::create([
            'nama' => 'Ririn Riandhita S.T',
            'username' => 'ririnriandhita',
            'password' => bcrypt('ririnriandhita'),
            'role_id' => 2
        ]);

        Guru::create([
            'user_id' => 2,
            'wali_kelas' => true,
            'piket' => false,
            'mapel' => true,
            'kaprodi' => true
        ]);

        User::create([
            'nama' => 'Imam Farniawan, S.Ds',
            'username' => 'imamfarniawan',
            'password' => bcrypt('imamfarniawan'),
            'role_id' => 2
        ]);

        Guru::create([
            'user_id' => 3,
            'wali_kelas' => true,
            'piket' => false,
            'mapel' => true,
            'kaprodi' => true
        ]);

        User::create([
            'nama' => 'M Ridwan Patawari, S.Sn',
            'username' => 'ridwanpatawari',
            'password' => bcrypt('ridwanpatawari'),
            'role_id' => 2
        ]);

        Guru::create([
            'user_id' => 4,
            'wali_kelas' => true,
            'piket' => false,
            'mapel' => true,
            'kaprodi' => true
        ]);

        Jurusan::create([
            'nama_jurusan' => 'PPLG',
            'kaprodi_id' => '2',
        ]);

        Jurusan::create([
            'nama_jurusan' => 'DKV',
            'kaprodi_id' => '3',
        ]);

        Jurusan::create([
            'nama_jurusan' => 'BCF',
            'kaprodi_id' => '4',
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-RPL',
            'wali_kelas_id' => 2,
            'jurusan_id' => 1,
            'tingkatan_kelas' => 12,
        ]);

        Kelas::create([
            'nama_kelas' => 'XII-MM',
            'wali_kelas_id' => 3,
            'jurusan_id' => 2,
            'tingkatan_kelas' => 12
        ]);

        User::create([
            'nama' => 'Fathul Bari',
            'username' => '00227',
            'password' => bcrypt('00227'),
            'role_id' => 3
        ]);

        Siswa::create([
            'user_id' => 5,
            'nis' => '00227',
            'nisInteger' => 227,
            'kelas_id' => 1,
            'jurusan_id' => 1,
        ]);

        User::create([
            'nama' => 'Achmad Surya Saputra',
            'username' => '00215',
            'password' => bcrypt('00215'),
            'role_id' => 3
        ]);

        Siswa::create([
            'user_id' => 6,
            'nis' => '00215',
            'nisInteger' => 215,
            'kelas_id' => 1,
            'jurusan_id' => 1,
        ]);

        User::create([
            'nama' => 'Aulia Nur Husin',
            'username' => '00257',
            'password' => bcrypt('00257'),
            'role_id' => 3
        ]);

        Siswa::create([
            'user_id' => 7,
            'nis' => '00257',
            'nisInteger' => 257,
            'kelas_id' => 2,
            'jurusan_id' => 2,
        ]);

        User::create([
            'nama' => 'Muthia Adenami M.Pd',
            'username' => 'muthiaadenami',
            'password' => bcrypt('muthiaadenami'),
            'role_id' => 2
        ]);

        Guru::create([
            'user_id' => 8,
            'wali_kelas' => true,
            'piket' => true,
            'mapel' => true,
            'kaprodi' => false
        ]);

        $mata_pelajaran = MataPelajaran::create([
            'nama_mapel' => 'Bahasa Inggris'
        ]);

        $mata_pelajaran->pengajars()->attach([8]);
        $mata_pelajaran->jurusans()->attach([1, 2, 3]);
    }
}
