<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Walas;
use Illuminate\Database\Seeder;

class WalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nig' => '99001111',
                'nama_walas' => 'Rudi Setiawan',
                'id_kelas' => 1,
                'password' => bcrypt('1234'),
            ],
            [
                'nig' => '99001122',
                'nama_walas' => 'Tari Melani',
                'id_kelas' => 2,
                'password' => bcrypt('1234'),
            ],

        ];
        foreach ($data as $walas) {
            Walas::create($walas);
        }
    }
}
