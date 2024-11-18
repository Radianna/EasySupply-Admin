<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    public function mappingProducts()
    {
        return $this->hasMany(MappingProduk::class, 'unit_id');
    }
}
