<?php

namespace Database\Seeders;

use App\Models\MappingProduk;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Toko1',
            'email' => 'toko1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        Role::create([
            'id' => 1,
            'name' => 'Admin',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Toko',
        ]);

        // eksekusi seeder lain
        $this->call(ProdukSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(MappingProdukSeeder::class);
    }
}
