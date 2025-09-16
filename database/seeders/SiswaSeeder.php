<?php

namespace Database\Seeders;

use App\Models\Siswa;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nis' => '1',
                'nama_siswa' => 'Arya',
                'id_kelas' => 1,
                'password' => bcrypt('1224001'),
            ],
            [
                'nis' => '1224002',
                'nama_siswa' => 'Amelia',
                'id_kelas' => 1,
                'password' => bcrypt('1224002'),
            ],
            [
                'nis' => '1224003',
                'nama_siswa' => 'Beka',
                'id_kelas' => 1,
                'password' => bcrypt('1224003'),
            ],
            [
                'nis' => '1224004',
                'nama_siswa' => 'Aji',
                'id_kelas' => 2,
                'password' => bcrypt('1224004'),
            ],
            [
                'nis' => '1224005',
                'nama_siswa' => 'Chiko',
                'id_kelas' => 2,
                'password' => bcrypt('1224005'),
            ],
            [
                'nis' => '1224006',
                'nama_siswa' => 'Eza',
                'id_kelas' => 2,
                'password' => bcrypt('1224006'),
            ],
        ];

        foreach ($data as $siswa) {
            Siswa::create($siswa);
        }
    }
}
