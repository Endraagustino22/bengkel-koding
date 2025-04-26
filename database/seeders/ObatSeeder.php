<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Botol',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Amoxilin',
                'kemasan' => 'Strip',
                'harga' => 10000
            ],
            [
                'nama_obat' => 'Betadine',
                'kemasan' => 'Botol',
                'harga' => 15000
            ],
            [
                'nama_obat' => 'CTM',
                'kemasan' => 'Strip',
                'harga' => 2000
            ],
            [
                'nama_obat' => 'OBH',
                'kemasan' => 'Botol',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Antalgin',
                'kemasan' => 'Strip',
                'harga' => 3000
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Botol',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Antibiotik',
                'kemasan' => 'Strip',
                'harga' => 10000
            ],
            [
                'nama_obat' => 'Antalgin',
                'kemasan' => 'Botol',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Strip',
                'harga' => 3000
            ],
            [
                'nama_obat' => 'Antibiotik',
                'kemasan' => 'Botol',
                'harga' => 10000
            ],
            [
                'nama_obat' => 'Antalgin',
                'kemasan' => 'Strip',
                'harga' => 5000
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Botol',
                'harga' => 3000
            ],
            [
                'nama_obat' => 'Antibiotik',
                'kemasan' => 'Strip',
                'harga' => 10000
            ],
            [
                'nama_obat' => 'Antalgin',
                'kemasan' => 'Botol',
                'harga' => 5000
            ]
            ];
        foreach ($data as $obat) {
            Obat::create([
                'nama_obat' => $obat['nama_obat'],
                'kemasan' => $obat['kemasan'],
                'harga' => $obat['harga']
            ]);
        }
    }
}
