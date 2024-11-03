<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class UserController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
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
        $password = bcrypt($request->password);
        $tambah=User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>$password,
            'alamat' =>$request->alamat,
            'kontak' =>$request->kontak,
            'role_id' =>$request->role_id
        ]);
        return response()->json("Berhasil ditambahkan", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $password = bcrypt($request->password);
        $user->update([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>$password,
            'alamat' =>$request->alamat,
            'kontak' =>$request->kontak,
            'role_id' =>$request->role_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'pesan'=> 'User berhasil dihapsus'
        ]);
    }
}
