<?php

namespace Database\Seeders;

use App\Models\DetailAlamat;
use App\Models\User;
use App\Models\UserAlamat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datauser= User::all();
        foreach ($datauser as $key => $data) {
            $randomdata= rand(1,4);
            $dataIDDetail=DetailAlamat::where('alamat_id', $randomdata)->inRandomOrder()->first()->detail_alamat_id;
            // dd($dataIDDetail);
            UserAlamat::create([
                'user_id'=>$data->user_id,
                'alamat_id'=>$randomdata,
                'detail_alamat_id'=>$dataIDDetail,
            ]);
        }
    }
}
