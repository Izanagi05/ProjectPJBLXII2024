<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRoles =['Admin RT 001','Admin RT 002','Admin RT 003','Admin RW'];

        foreach ($adminRoles as$key=> $role) {
            AdminRole::create([
                'nama' => $role,
                'rt_id' =>  rand(1,3),
            ]);
        }
    }
}
