<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\MappingProduk;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\Utils;

class TokoController extends Controller
{
    public function getBatchImageProduk(Request $request)
    {
        $filePaths = $request->input('file_paths');

        // Validasi input
        if (empty($filePaths) || !is_array($filePaths)) {
            return response()->json(['error' => 'Invalid or missing file paths'], 400);
        }

        $client = new Client();
        $apiUrl = env('API_URL');
        $responses = [];

        // Proses setiap file path menggunakan Guzzle
        foreach ($filePaths as $filePath) {
            try {
                $absolutePath = public_path('storage/produk/' . $filePath);

                // Pastikan file gambar ada sebelum mengirimkan request
                if (!file_exists($absolutePath)) {
                    $responses[] = [
                        'filename' => $filePath,
                        'error' => 'File not found'
                    ];
                    continue;
                }

                $responses[] = $client->postAsync($apiUrl . '/api/upload-image', [
                    'multipart' => [
                        [
                            'name'     => 'image',
                            'contents' => fopen($absolutePath, 'r'),
                            'filename' => basename($filePath),
                        ],
                        [
                            'name'     => 'image_name',
                            'contents' => basename($filePath),
                        ],
                    ],
                ]);
            } catch (\Exception $e) {
                $responses[] = [
                    'filename' => $filePath,
                    'error' => $e->getMessage(),
                ];
            }
        }

        try {
            // Menunggu semua permintaan selesai
            $results = Utils::settle($responses)->wait();

            $imageData = array_map(function ($result) {
                if ($result['state'] === 'fulfilled') {
                    $data = json_decode($result['value']->getBody(), true);
                    return [
                        'filename' => basename($data['path']),
                        'path' => $data['path'],
                        'message' => $data['message'],
                    ];
                } else {
                    return [
                        'error' => $result['reason']->getMessage(),
                    ];
                }
            }, $results);

            return response()->json($imageData, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Batch processing failed: ' . $e->getMessage()], 500);
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
        try {
            return $this->atomic(function () use ($request) {
                // Validasi data request
                $validated = $request->validate([
                    'user_id' => 'required|exists:users,id',
                    'totalPesanan' => 'required|integer|min:1',
                    'totalHarga' => 'required|numeric|min:0',
                    'detail_pesanan.*.id' => 'required|exists:mapping_produks,id',
                    'detail_pesanan.*.quantity' => 'required|integer|min:1',
                    'detail_pesanan.*.harga' => 'required|numeric|min:0',
                ]);

                // Generate referensi pesanan
                $ref = 'ESP-' . date('Ymd') . mt_rand(100, 999);

                // Simpan data pesanan ke tabel Pesanan
                $pesanan = Pesanan::create([
                    'ref' => $ref,
                    'user_id' => $validated['user_id'],
                    'total_item' => $validated['totalPesanan'],
                    'total_harga' => $validated['totalHarga'],
                    'tanggal_pesanan' => now(),
                    'status_pesanan' => 'menunggu konfirmasi',
                ]);

                // Simpan detail pesanan
                foreach ($validated['detail_pesanan'] as $detail) {
                    $pesanan->detail_pesanan()->create([
                        'mapping_produk_id' => $detail['id'],
                        'jumlah' => (int)$detail['quantity'],
                        'harga_satuan' => $detail['harga'],
                        'subtotal' => (int)$detail['quantity'] * $detail['harga'],
                    ]);
                }

                // Kembalikan respons JSON
                return response()->json([
                    'status' => 'success',
                ]);
            });
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan pesanan.',
            ], 500);
        }
    }
}
