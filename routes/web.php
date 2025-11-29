<?php

use App\Http\Controllers\BrandController;
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