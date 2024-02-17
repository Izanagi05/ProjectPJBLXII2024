<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayProvince = [
            'NAD Aceh',
            'Sumatera Utara',
            'Sumatera Barat',
            'Sumatera Selatan',
            'Riau',
            'Kepulauan Riau',
            'Jambi',
            'Bengkulu',
            'Bangka Belitung',
            'Lampung',
            'Banten',
            'Jawa Barat',
            'Jawa Tengah',
            'Jawa Timur',
            'DKI Jakarta',
            'Daerah Istimewa Yogyakarta',
            'Bali',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Kalimantan Barat',
            'Kalimantan Selatan',
            'Kalimantan Tengah',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Gorontalo',
            'Sulawesi Selatan',
            'Sulawesi Tenggara',
            'Sulawesi Tengah',
            'Sulawesi Utara',
            'Sulawesi Barat',
            'Maluku',
            'Maluku Utara',
            'Papua',
            'Papua Barat',
        ];
        foreach ($arrayProvince as $key => $dt) {
            Provinsi::create(["provinsi" => $dt]);
            // # code...
        }
    }
}
