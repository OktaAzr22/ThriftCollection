<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\secondaryController;
use App\Http\Controllers\TokoController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::resource('brands', BrandController::class);

// Route untuk melihat item milik brand tertentu
Route::get('brands/{brand}/items', [BrandController::class, 'items'])->name('brands.items');



Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
Route::put('/toko/{toko}', [TokoController::class, 'update'])->name('toko.update');
Route::delete('/toko/{toko}', [TokoController::class, 'destroy'])->name('toko.destroy');




Route::get('/master', [secondaryController::class, 'index'])->name('master.index');

/* Kategori */
Route::post('/master/kategori', [secondaryController::class, 'storeKategori'])->name('master.kategori.store');
Route::put('/master/kategori/{kategori}', [secondaryController::class, 'updateKategori'])->name('master.kategori.update');
Route::delete('/master/kategori/{kategori}', [secondaryController::class, 'deleteKategori'])->name('master.kategori.destroy');

/* Color */
Route::post('/master/color', [secondaryController::class, 'storeColor'])->name('master.color.store');
Route::put('/master/color/{color}', [secondaryController::class, 'updateColor'])->name('master.color.update');
Route::delete('/master/color/{color}', [secondaryController::class, 'deleteColor'])->name('master.color.destroy');

Route::resource('items', ItemController::class)->except(['create', 'show']);
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
