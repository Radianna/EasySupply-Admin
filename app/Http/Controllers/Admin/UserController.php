<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('admin.manage-user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-user.create');
    }

    public function getUserData(Request $request)
    {
        try {
            $search = $request->input('search');
            $query = User::with('roles');

            if ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%");
            }

            $users = $query->select('id', 'name', 'email', 'alamat', 'role_id')->get();

            // Sesuaikan format data yang dikembalikan
            $formattedRoles = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'alamat' => $user->alamat,
                    'role' => $user->roles->pluck('name')->implode(', ')
                ];
            });

            return response()->json(['results' => $formattedRoles]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // Gunakan 'confirmed' untuk cek password dan password2
            'alamat' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id'
        ]);

    
        // Jika validasi gagal, kembalikan response error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }
    
        try {
            // Membuat user baru
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Gunakan Hash::make
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'role_id' => $request->role_id
            ]);
    
            return response()->json("Berhasil ditambahkan", 201); // Gunakan status code 201 untuk created
        } catch (QueryException $e) {
            // Tangani kesalahan query, misal duplikasi data
            return response()->json(['error' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
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
        try {
            if ($request->password == $request->password2) {
                $password = bcrypt($request->password);
            } else {
                return response()->json(['error' => 'Password tidak cocok'], 400);
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'role_id' => $request->role_id
            ]);
            return response()->json("Berhasil diubah", 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memuat data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'pesan' => 'User berhasil dihapsus'
        ]);
    }
}
