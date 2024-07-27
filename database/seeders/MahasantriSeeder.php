<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasantri')->insert([
            [
                'nim' => '2301001', 
                'nama' => 'Abil Arqam Sayuri',
                'asal' => 'Sulawesi Utara',
                'kelas' => 'ppl', 
                'tahun_ajaran' => '2023/2024',
                'lulus' => 1,
                'keterangan' => 'keterangan',
            ]
        ]);
    }
}
