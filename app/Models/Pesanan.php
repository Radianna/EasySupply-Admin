<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_pesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
