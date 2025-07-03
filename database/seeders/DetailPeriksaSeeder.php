<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_periksa')->insert([
            [
                'id_periksa'  => 1,
                'id_obat'     => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_periksa'  => 1,
                'id_obat'     => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_periksa'  => 2,
                'id_obat'     => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }

}
