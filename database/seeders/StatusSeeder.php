<?php

namespace Database\Seeders;

use App\Models\StatusPerizinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPerizinan::create([
            'nama' => 'Belum Diizinkan'
        ]);

        StatusPerizinan::create([
            'nama' => 'Tidak Diizinkan'
        ]);

        StatusPerizinan::create([
            'nama' => 'Sudah Diizinkan'
        ]);
    }
}
