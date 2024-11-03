<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = Pesanan::all();
        return response()->json($pesanan, 200);
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
        $tambah=Pesanan::create([
            'user_id' =>$request->user_id,
            'tanggal_pesanan' =>$request->tanggal_pesanan,
            'total_harga' =>$request->total_harga,
            'status_pesanan' =>$request->status_pesanan
        ]);
        return response()->json("Berhasil ditambahkan", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        $pesanan->update([
            'user_id' =>$request->user_id,
            'tanggal_pesanan' =>$request->tanggal_pesanan,
            'total_harga' =>$request->total_harga,
            'status_pesanan' =>$request->status_pesanan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return response()->json([
            'pesan'=> 'Pesanan berhasil dihapsus'
        ]);
    }
}
