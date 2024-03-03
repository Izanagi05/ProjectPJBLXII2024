<?php

namespace Database\Seeders;

use App\Models\TataTertib;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tatibseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tataTertibs = [
            [
                'judul' => 'Pendaftaran Akun Warga',
                'deskripsi' => 'Setiap warga harus mendaftar akun di aplikasi kami.'
            ],
            [
                'judul' => 'Pembayaran Iuran Warga',
                'deskripsi' => 'Setiap warga wajib melakukan pembayaran iuran bulanan.'
            ],
            [
                'judul' => 'Permintaan Perbaikan Jalan',
                'deskripsi' => 'Warga dapat mengajukan permintaan perbaikan jalan di wilayah sekitar.'
            ],
            [
                'judul' => 'Pengumuman Kegiatan Komunitas',
                'deskripsi' => 'Pengumuman tentang acara kebersihan lingkungan harus diposting.'
            ],
            [
                'judul' => 'Pembaruan Data Penduduk',
                'deskripsi' => 'Setiap warga harus melakukan pembaruan data penduduk secara berkala.'
            ]
        ];

        foreach ($tataTertibs as $tataTertib) {
            TataTertib::create($tataTertib);
        }
    }
}
