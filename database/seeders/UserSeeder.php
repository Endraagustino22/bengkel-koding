<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Endra Agustino',
                'alamat' => 'Jl. Poncowolo',
                'no_hp' => '0812345678900',
                'role' => 'dokter',
                'email' => 'endra@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'Bonjur',
                'alamat' => 'Jl. Pamularsih',
                'no_hp' => '082345678901',
                'role' => 'dokter',
                'email' => 'bonjur@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'Bimo Android',
                'alamat' => 'Jl. Pamularsih',
                'no_hp' => '08531646464',
                'role' => 'pasien',
                'email' => 'bimoandroid@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'bemo',
                'alamat' => 'Jl. Pamularsih',
                'no_hp' => '08531121212',
                'role' => 'pasien',
                'email' => 'bemo@gmail.com',
                'password' => 'password',
            ],
            [
                'nama' => 'shinta',
                'alamat' => 'Jl. Indraprasta',
                'no_hp' => '085333333333',
                'role' => 'pasien',
                'email' => 'shinta@gmail.com',
                'password' => '111111',
            ],
            [
                'nama' => 'endra admin',
                'alamat' => 'Jl. Pantura',
                'no_hp' => '085333112312',
                'role' => 'admin',
                'email' => 'endraadmin@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach($data as $d){
            User::create([
                'nama' => $d['nama'],
                'email' => $d['email'],
                'password' => $d['password'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
            ]);
        }
    }
}
