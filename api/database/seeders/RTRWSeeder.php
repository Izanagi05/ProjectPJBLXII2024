<?php

namespace Database\Seeders;

use App\Models\Rt;
use App\Models\RW;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RTRWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rw::create([
            'nama' => 'RW 006',
            'no' => '12345',
            'tanggal' => '2024-02-14',
            'kota' => 'KOTA Bekasi',
            'alamat' => ' Kecamatan Ciketing udik',
            'ketua_rw' => 'Udin owaiue',
            'wakil_rw' => 'owiaiwun sis'
        ]);
        Rt::create([
            'rt' => 'RT 001',
            'ketua_rt' => 'Ketua_RT_001',
            'wakil_ketua_rt' => 'Wakil_Ketua_RT_001',
        ]);

        Rt::create([
            'rt' => 'RT 002',
            'ketua_rt' => 'Ketua_RT_002',
            'wakil_ketua_rt' => 'Wakil_Ketua_RT_002',
        ]);

        Rt::create([
            'rt' => 'RT 003',
            'ketua_rt' => 'Ketua_RT_003',
            'wakil_ketua_rt' => 'Wakil_Ketua_RT_003',
        ]);
    }
}
