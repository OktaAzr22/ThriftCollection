<?php
    use App\Http\Controllers\BrandController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ItemController;
    use App\Http\Controllers\secondaryController;
    use App\Http\Controllers\TokoController;

    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login', function (Request $request) {

        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        session([
            'nama' => $request->nama,
            'password' => $request->password
        ]);

        if ($request->nama === 'okta') {
            return redirect('/dashboard');
        }

        return redirect('/guest');
    });

    Route::middleware(['hakakses'])->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/dashboard/cetak', [DashboardController::class, 'cetakPDF'])
            ->name('dashboard.cetak');

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

        Route::view('/hak-akses', 'hakakses')->name('hakakses');

    });

    Route::get('/guest', function () {

        if (!session('nama')) {
            return redirect('/');
        }

        return view('guest');

    })->name('guest.index');

    Route::get('/logout', function () {

        session()->flush();
        session()->regenerate();

        return redirect('/');

    })->name('token.logout');