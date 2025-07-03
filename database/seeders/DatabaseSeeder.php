<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DetailPeriksa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            PoliSeeder::class,
            DokterSeeder::class,
            JadwalPeriksaSeeder::class,
            PasienSeeder::class,
            DaftarPoliSeeder::class,
            ObatSeeder::class,
            PeriksaSeeder::class,
            DetailPeriksaSeeder::class,
        ]);
    }
}
