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
            ['name' => 'Biskuit Coklat', 'gambar' => 'https://tse3.mm.bing.net/th?id=OIP.TYIMNiz0cwSWVQLTJ8URgHaHa&pid=Api&P=0&h=180', 'kategori' => 'makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Air Mineral', 'gambar' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/93/MTA-3325719/aqua_aqua-botol-air-mineral.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Piring Melamin', 'gambar' => 'https://cf.shopee.co.id/file/d31e68171bccc98e7c10a084c13e70f5', 'kategori' => 'perabotan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Kopi Sachet', 'gambar' => 'https://cf.shopee.co.id/file/bfac5c94aad5cbadd6e2239bfc99f', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sapu Lidi', 'gambar' => 'https://img.mbizmarket.co.id/products/thumbs/80x800/2022/06/20/sapu_lidi.jpg', 'kategori' => 'perabotan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Keripik Kentang', 'gambar' => 'https://down-id.img.susercontent.com/file/f910184a81d615af726046891a9d1e71', 'kategori' => 'makanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Teh Celup', 'gambar' => 'https://i.etsystatic.com/12083047/r/il/3b05c/3160986944/il_1588xN.3160986944_3k7.jpg', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Gelas Plastik', 'gambar' => 'https://www.static-src.com/images/catalog/full/100/MTA-7726375/gelas_plastik.jpg', 'kategori' => 'lain-lain', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sabun Cuci', 'gambar' => 'https://s0.bukalapak.com/img/0061967791/w-1000/Sabun_Cuci.jpg', 'kategori' => 'lain-lain', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Susu Kotak', 'gambar' => 'https://tse3.mm.bing.net/th?id=OIP.cwL1FNgW_7DR-AmoRPxCAHaKL&pid=Api&P=0&h=180', 'kategori' => 'minuman', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
