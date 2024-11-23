<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.manage-produk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-produk.create');
    }


    public function getProdukData(Request $request)
    {
        try {
            $search = $request->input('search');
            $query = Produk::query();

            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('kategori', 'LIKE', "%{$search}%");
            }

            $produks = $query->select('id', 'name', 'gambar', 'kategori')->get();
            // Sesuaikan format data yang dikembalikan
            $formattedData = $produks->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'gambar' => $user->gambar,
                    'kategori' => $user->kategori
                ];
            });

            return response()->json(['results' => $formattedData]); // Pastikan ini mengembalikan JSON lengkap
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('produk', 'public');
            $data['gambar'] = $path;
        }
        $create = Produk::create($data);
        return back()->with('success', 'Peserta didik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $data = Produk::findOrFail($id);

        return view('admin.manage-produk.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $this->updateValidate($request);

        $data = $request->all();
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $path = $file->store('produk', 'public');
            $data['gambar'] = str_replace('produk/', '', $path);
        }

        try {
        return $this->atomic(function () use ($data, $id) {
            $update = Produk::findOrFail($id)->update($data);
            
            return response()->json([
                'status' => true,
                'massage' => 'Data berhasil diubah'
            ]);
        });
        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'massage' => 'Data gagal diubah'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json([
            'pesan' => 'Produk berhasil dihapus'
        ]);
    }

    public function updateValidate(Request $request)
    {
        $validate = $request->validate([
            'name'     => 'required',
            //kategori='makanan','minuman','perabotan','lain-lain'
            'kategori'   => 'required',
            'gambar' =>'file|mimes:svg,jpg,jpeg,png|max:2048',
        ]);

        return $validate;
    }


}
