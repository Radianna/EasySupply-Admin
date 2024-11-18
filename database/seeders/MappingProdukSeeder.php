<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MappingProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('mapping_produks')->insert([
            ['produk_id' => 1, 'unit_id' => 1, 'harga' => 12000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 2, 'unit_id' => 2, 'harga' => 5000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 3, 'unit_id' => 1, 'harga' => 15000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 4, 'unit_id' => 2, 'harga' => 2000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 5, 'unit_id' => 1, 'harga' => 25000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 6, 'unit_id' => 2, 'harga' => 10000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 7, 'unit_id' => 2, 'harga' => 8000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 8, 'unit_id' => 1, 'harga' => 2000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 9, 'unit_id' => 1, 'harga' => 9000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 10, 'unit_id' => 2, 'harga' => 12000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 1, 'unit_id' => 2, 'harga' => 11000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 2, 'unit_id' => 1, 'harga' => 4500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 3, 'unit_id' => 2, 'harga' => 16000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 4, 'unit_id' => 1, 'harga' => 1800, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 5, 'unit_id' => 2, 'harga' => 24000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 6, 'unit_id' => 1, 'harga' => 9500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 7, 'unit_id' => 1, 'harga' => 7500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 8, 'unit_id' => 2, 'harga' => 2100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 9, 'unit_id' => 2, 'harga' => 8500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['produk_id' => 10, 'unit_id' => 1, 'harga' => 11500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
