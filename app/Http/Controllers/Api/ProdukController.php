<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return response()->json($produk, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tambah=Produk::create([
            'name' =>$request->name,
            'kategori' =>$request->kategori,
            'stock' =>$request->stock,
            'harga' =>$request->harga
        ]);
        return response()->json("Berhasil ditambahkan", 200);
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
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $produk->update([
            'name' =>$request->name,
            'kategori' =>$request->kategori,
            'stock' =>$request->stock,
            'harga' =>$request->harga

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json([
            'pesan'=> 'Produk berhasil dihapsus'
        ]);
    }
}
