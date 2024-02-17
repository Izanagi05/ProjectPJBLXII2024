<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AgamaSeeder::class);
        $this->call(RTRWSeeder::class);
        $this->call(AlamatSeeder::class);
        $this->call(BulanTahunSeeder::class);
        $this->call(DaerahSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserAlamatSeeder::class);
    }
}
