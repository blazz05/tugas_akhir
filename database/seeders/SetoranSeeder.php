<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetoranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setoran')->insert([
            [
                'tanggal' => '2024-05-05', 
                'waktu' => 'pagi',
                'juz' => 29,
                'halaman' => 10, 
                'mahasantri_id' => 1, 
            ]
        ]);
    }
}
