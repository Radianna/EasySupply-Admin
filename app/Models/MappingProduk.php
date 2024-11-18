<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingProduk extends Model
{
    protected $table = 'mapping_produks';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
