<?php

namespace Database\Seeders;

use App\Models\JadwalPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 1,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 4,
            'guru_id' => 11
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 2,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 4,
            'guru_id' => 11
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 3,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 4,
            'guru_id' => 11
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 4,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 5,
            'guru_id' => 12
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 5,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 5,
            'guru_id' => 12
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 6,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 5,
            'guru_id' => 12
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 7,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 6,
            'guru_id' => 10
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 8,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 6,
            'guru_id' => 10
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 9,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 6,
            'guru_id' => 10
        ]);

        JadwalPelajaran::create([
            'hari' => 'Monday',
            'jam_pelajaran' => 10,
            'kelas_id' => 1,
            'mata_pelajaran_id' => 6,
            'guru_id' => 10
        ]);
    }
}
