<?php

use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::get('admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::prefix('admin')->name('admin.')->group(function () {
    //user
    Route::get('manage-user/data', [UserController::class, 'getUserData'])->name('manage-user.data');
    Route::resource('manage-user', UserController::class);
    //role
    Route::get('manage-role/data', [RoleController::class, 'getRoleData'])->name('manage-role.data');
    Route::resource('manage-role', RoleController::class);
    //produk
    Route::get('manage-produk/data', [ProdukController::class, 'getProdukData'])->name('manage-produk.data');
    Route::resource('manage-produk', ProdukController::class);
    //pesanan
    Route::get('manage-pesanan/data', [PesananController::class, 'getPesananData'])->name('manage-pesanan.data');
    Route::resource('manage-pesanan', PesananController::class);

});


});

require __DIR__.'/auth.php';
