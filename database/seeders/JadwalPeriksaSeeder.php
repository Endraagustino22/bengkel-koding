<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_periksas')->insert([
            [
                'id_dokter' => 1,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dokter' => 1,
                'hari' => 'Rabu',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'status' => 'non-aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
