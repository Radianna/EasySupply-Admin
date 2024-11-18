<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';
    protected $guarded = [];

    public function mappingProducts()
    {
        return $this->hasMany(MappingProduk::class, 'produk_id');
    }
}
