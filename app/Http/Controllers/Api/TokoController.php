<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\MappingProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function getListProduk()
    {
        // Mengambil semua data dari tabel `mapping_product` beserta relasi `produk` dan `unit`
        $mappingProduk = MappingProduk::with(['produk', 'unit'])
            ->get()
            ->filter(function ($item) {
                // Memastikan relasi `produk` dan `unit` tersedia sebelum diproses
                return $item->produk && $item->unit;
            });
    
        // Mengelompokkan data berdasarkan `produk_id`
        $groupedProduk = $mappingProduk->groupBy('produk_id')->map(function ($group) {
            // Mengambil data produk dari item pertama dalam setiap grup
            $firstItem = $group->first();
    
            return [
                'id' => $firstItem->produk->id,
                'name' => $firstItem->produk->name,
                'gambar' => $firstItem->produk->gambar,
                'harga' => $firstItem->harga,
                'stock' => $group->sum('stock'), // Menjumlahkan stok dari semua unit yang terkait
                'units' => $group->map(function ($item) {
                    return [
                        'unit_name' => $item->unit->name,
                        'harga' => $item->harga,
                    ];
                })->values(),
            ];
        })->values();
    
        // Mengembalikan response dalam bentuk JSON
        return response()->json($groupedProduk);
    }
}
