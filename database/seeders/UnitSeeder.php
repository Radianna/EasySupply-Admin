<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UnitSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            ['name' => 'pcs', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'pack', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
