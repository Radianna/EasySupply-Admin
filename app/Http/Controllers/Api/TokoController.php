<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\MappingProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TokoController extends Controller
{

    public function getImageProduk($filePath)
    {
        $client = new Client(); // Inisialisasi Guzzle Client
        $apiUrl = env('API_URL'); // Mendapatkan URL API dari environment
        $path = public_path('storage/produk/' . $filePath);
    
        // Validasi apakah file ada
        if (!file_exists($path)) {
            return ['error' => 'File not found'];
        }
    
        try {
            // Kirim file ke API proyek B
            $response = $client->post($apiUrl . '/api/upload-image', [
                'multipart' => [
                    [
                        'name'     => 'image', // Nama field untuk file
                        'contents' => fopen($path, 'r'), // Membuka file untuk dikirim
                        'filename' => basename($path), // Nama file asli
                    ],
                    [
                        'name'     => 'image_name', // Nama field untuk nama file yang akan disimpan
                        'contents' => basename($path), // Menggunakan nama file asli
                    ],
                ],
            ]);
    
            // Decode response API
            $result = json_decode($response->getBody(), true);
            return $result; // Return hasil response
        } catch (\Exception $e) {
            // Tangani error
            return ['error' => $e->getMessage()];
        }
    }

    public function getListProduk()
    {
        // Mengambil data dari model `Produk` beserta relasi `mappingProducts` dan `unit`
        $produkList = Produk::with(['mappingProducts.unit'])
            ->get()
            ->filter(function ($produk) {
                // Memastikan produk memiliki relasi `mappingProducts` yang valid
                return $produk->mappingProducts->isNotEmpty();
            })
            ->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'name' => $produk->name,
                    'gambar' => $produk->gambar,
                    'harga' => $produk->mappingProducts->first()->harga, // Harga default dari mapping pertama
                    'units' => $produk->mappingProducts->map(function ($mapping) {
                        return [
                            'id' => $mapping->id, // Menyertakan id dari mapping_product
                            'unit_name' => $mapping->unit->name,
                            'harga' => $mapping->harga,
                        ];
                    })->values(),
                ];
            })
            ->values();

        // Mengembalikan response dalam bentuk JSON
        return response()->json($produkList);
    }

    public function getDataProduk($id)
    {
        // Mengambil data dari tabel mapping_product dengan relasi produk dan unit
        $produkData = MappingProduk::where('id', $id)->with(['produk', 'unit'])
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->produk->name,
                    'gambar' => $item->produk->gambar,
                    'harga' => $item->harga,
                    'unit' => $item->unit->name,
                ];
            });

        // Mengembalikan response dalam bentuk JSON
        return response()->json($produkData);
    }

    public function checkout(Request $request)
    {
        // Mendapatkan data pesanan dari request
        $pesanan = $request->pesanan;
        $detailPesanan = $request->detail_pesanan;

        // Simpan data pesanan dan detail pesanan ke database
        $pesanan = DetailPesanan::create($pesanan);
        foreach ($detailPesanan as $detail) {
            DetailPesanan::create($detail);
        }

        // Mengembalikan response dalam bentuk JSON
        return response()->json([
            'pesan' => 'Pesanan berhasil dikirim',
        ]);
    }
}
