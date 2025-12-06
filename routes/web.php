<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\secondaryController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('token'); 
})->name('token.form');

Route::get('/test', function() {
    return view ('test');
});

Route::post('/set-token', function (Illuminate\Http\Request $request) {
    $request->validate(['token' => 'required']);
    session(['auth_token' => $request->token]);

    return redirect('/dashboard');
});


Route::get('/guest', function () {
    return view('guest');  
})->name('guest.index');


Route::middleware(['token'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('brands', BrandController::class);

    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
    Route::put('/toko/{toko}', [TokoController::class, 'update'])->name('toko.update');
    Route::delete('/toko/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');

    Route::get('/master', [secondaryController::class, 'index'])->name('master.index');

    Route::post('/master/kategori', [secondaryController::class, 'storeKategori'])->name('master.kategori.store');
    Route::put('/master/kategori/{kategori}', [secondaryController::class, 'updateKategori'])->name('master.kategori.update');
    Route::delete('/master/kategori/{kategori}', [secondaryController::class, 'deleteKategori'])->name('master.kategori.destroy');

    Route::post('/master/color', [secondaryController::class, 'storeColor'])->name('master.color.store');
    Route::put('/master/color/{color}', [secondaryController::class, 'updateColor'])->name('master.color.update');
    Route::delete('/master/color/{color}', [secondaryController::class, 'deleteColor'])->name('master.color.destroy');

    Route::resource('items', ItemController::class)->except(['create', 'show']);
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    Route::get('/brand/{id}/items', [BrandController::class, 'ajaxItems']);

    Route::get('/item/{id}/detail', [ItemController::class, 'ajaxDetail']);

    Route::get('/items/{item}', function(App\Models\Item $item){
        return response()->json($item);
    });
});

Route::get('/logout-token', function () {
    session()->forget('auth_token');
    return redirect('/')->with('success', 'Token berhasil dihapus.');
})->name('token.logout');