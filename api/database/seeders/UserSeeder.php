<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kelamin = ['Laki-laki', 'Perempuan'];
        $random_jenis_kelamin = $jenis_kelamin[array_rand($jenis_kelamin)];
        for ($i = 0; $i < 14; $i++) {
            User::create([
                'nama' => 'testing' . $i,
                'email' => 'test' . $i . '@gmail.com',
                'password' => 'password',
                'jenis_kelamin' => $random_jenis_kelamin,
                'nik' => null,
                'no_kk'=>null,
                'foto_ktp' => null,
                'foto_kk' => null,
                'provinsi_lahir_id' => 3,
                'tempat_lahir_lainnya' => null,
                'tgl_lahir' => null,
                'no_telp' => '0812939392828',
                'pekerjaan' => null,
                'hubungan' => null,
                'status_berktp' => 'Belum',
                'status_perkawinan' => null,
                'agama_id' => null,
                'role'=>'User',
            ]);
        }
        $adminRoles = ['rt001', 'rt002', 'rt003'];
        for ($i = 0; $i < 3; $i++) {
            User::create([
                'nama' => 'admin' . $i . $adminRoles[$i],
                'email' => 'admin' . $i . $adminRoles[$i] . '@gmail.com',
                'password' => 'password',
                'jenis_kelamin' => $random_jenis_kelamin,
                'nik' => null,
                'no_kk'=>null,
                'foto_ktp' => null,
                'foto_kk' => null,
                'provinsi_lahir_id' => 3,
                'tempat_lahir_lainnya' => null,
                'tgl_lahir' => null,
                'no_telp' => '0812939392828',
                'pekerjaan' => null,
                'hubungan' => null,
                'status_berktp' => 'Belum',
                'status_perkawinan' => null,
                'agama_id' => null,
                'role'=>'Admin',
            ]);
        }
         User::create([
                'nama' => 'admin pusat1 RW007' ,
                'email' => 'adminrw007' .   '@gmail.com',
                'password' => 'password',
                'jenis_kelamin' =>$random_jenis_kelamin,
                'nik' => null,
                'no_kk'=>null,
                'foto_ktp' => null,
                'foto_kk' => null,
                'provinsi_lahir_id' => 3,
                'tempat_lahir_lainnya' => null,
                'tgl_lahir' => null,
                'no_telp' => '0812939392828',
                'pekerjaan' => null,
                'hubungan' => null,
                'status_berktp' => 'Belum',
                'status_perkawinan' => null,
                'agama_id' => null,
                'role'=>'Admin',
            ]);
    }
}
