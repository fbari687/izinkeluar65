<?php

namespace Database\Seeders;

use App\Models\KeteranganPerizinan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeteranganPerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            KeteranganPerizinan::create([
                'name' => $i
            ]);
        }

        KeteranganPerizinan::create([
            'name' => 'piket'
        ]);

        KeteranganPerizinan::create([
            'name' => 'wali_kelas'
        ]);
    }
}
