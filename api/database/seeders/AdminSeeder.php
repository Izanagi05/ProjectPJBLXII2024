<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\AdminRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Admin::create([
            'user_id'=>15,
            'admin_role_id'=>1
        ]);
        Admin::create([
            'user_id'=>16,
            'admin_role_id'=>2
        ]);
        Admin::create([
            'user_id'=>17,
            'admin_role_id'=>3
        ]);
        Admin::create([
            'user_id'=>18,
            'admin_role_id'=>4
        ]);
    }
}
