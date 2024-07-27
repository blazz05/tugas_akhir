<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
    

class TasmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasmi')->insert([
            [
                'tanggal' => '2024-05-05', 
                'waktu' => 'Pagi',
                'keterangan' => 'مردود',
                'setoran_id' => 2,
                'setoran_mahasantri_id' => 1, 
            ]
        ]);
    }
}
