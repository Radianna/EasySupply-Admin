<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('produks')->insert([
            ['name' => 'Biskuit Coklat', 'gambar' => 'HEcvBcmBKoMryIu2jwWnKmoK3VnxH78Jt0XecP33.jpg', 'kategori' => 'makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Air Mineral', 'gambar' => '8SQVraJLeM9yE3EMQhNkrHE4mnSxOB23KJmd8k9a.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Piring Melamin', 'gambar' => 'edlPhtJfV9AKhJBfNlPtQs1GVflZoQHbICDNJy3F.jpg', 'kategori' => 'perabotan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kopi Sachet', 'gambar' => 'uyx4IlAdPBmYuy2DHc9AD8bPEubjzANoF5BDj1cd.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sapu Lidi', 'gambar' => 'hSyv9vuCHoxkDXyoW09GlOqBpuDP6bYTN1EImHF4.jpg', 'kategori' => 'perabotan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Keripik Kentang', 'gambar' => 'zOssZqfSCU1WrbsEYDuSSEWRhvM96j1z7SjQoyAT.jpg', 'kategori' => 'makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Teh Celup', 'gambar' => '2O0WGZfw6CZJ3aSqPH6k12HDJtE3g4yKPqW39zfm.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Gelas Plastik', 'gambar' => 'hxdIJZbFHTRu6NkyTUdwzPSoRoCn51azqm6vLMwI.jpg', 'kategori' => 'lain-lain', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sabun Cuci', 'gambar' => 'U42n3eBPncbIcAWD6AQbo1nYS6cFhXb73kOqboHl.jpg', 'kategori' => 'lain-lain', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Susu Kotak', 'gambar' => '9jJ37qOmrsbpfryL7OkQ6LuJkYoSXLsefofSgWde.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
