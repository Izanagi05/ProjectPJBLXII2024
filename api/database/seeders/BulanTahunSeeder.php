<?php

namespace Database\Seeders;

use App\Models\Bulan;
use App\Models\Tahun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BulanTahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahunSekarang = date('Y');

        $tahunArray = [];
        for ($tahun = 2020; $tahun <= $tahunSekarang; $tahun++) {
            Tahun::create(['nama'=>$tahun]);
        }

        $bulan = [
            ['nama' => 'Januari'],
            ['nama' => 'Februari'],
            ['nama' => 'Maret'],
            ['nama' => 'April'],
            ['nama' => 'Mei'],
            ['nama' => 'Juni'],
            ['nama' => 'Juli'],
            ['nama' => 'Agustus'],
            ['nama' => 'September'],
            ['nama' => 'Oktober'],
            ['nama' => 'November'],
            ['nama' => 'Desember']
        ];

        // Memasukkan data bulan ke dalam tabel bulan
        Bulan::insert($bulan);

    }
}
