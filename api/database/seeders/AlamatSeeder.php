<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blok = ['A', 'B', 'C', 'D'];
        $jalan = [
            ['Jalan Anggrek', 'Jalan Mawar', 'Jalan Melati'],
            ['Jalan Srikaya', 'Jalan Nangka', 'Jalan Durian'],
            ['Jalan Salak', 'Jalan Delima', 'Jalan Mangga'],
            ['Jalan Jeruk', 'Jalan Semangka', 'Jalan Pisang'],
        ];

        foreach ($blok as $index => $b) {
            $alamat = Alamat::create([
                'nama' => 'Blok ' . $b,
                'rt_id' => rand(1,3),
            ]);
            foreach ($jalan[$index] as $j) {
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
