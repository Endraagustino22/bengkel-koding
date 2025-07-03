<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pasiens')->insert([

            [
                'nama' => 'Bimo Android',
                'id_user' => 3,
                'alamat' => 'Jl. Pamularsih',
                'no_ktp' => '1234567890123456',
                'no_hp' => '08531646464',
                'no_rm' => now()->format('Ym') . '-3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'bemo',
                'id_user' => 4,
                'alamat' => 'Jl. Pamularsih',
                'no_ktp' => '9876543210987654',
                'no_hp' => '08531121212',
                'no_rm' => now()->format('Ym') . '-4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'shinta',
                'id_user' => 5,
                'alamat' => 'Jl. Indraprasta',
                'no_ktp' => '374994544444',
                'no_hp' => '085333333333',
                'no_rm' => now()->format('Ym') . '-5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
