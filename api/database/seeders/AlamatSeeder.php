<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blok = ['A', 'B', 'C', 'D'];
        $jalan = ['Jalan Anggrek', 'Jalan Mawar', 'Jalan Melati'];

        foreach ($blok as $b) {
            $alamat = Alamat::create([
                'nama' => 'Blok ' . $b,
                'rt_id' => 1,
            ]);
            foreach ($jalan as $j) {
                for ($i = 1; $i <= 6; $i++) {
                    DetailAlamat::create([
                        'alamat_id' => $alamat->alamat_id,
                        'nama' => $j . ' No ' . $i,
                    ]);
                }
            }
        }
    }
}
