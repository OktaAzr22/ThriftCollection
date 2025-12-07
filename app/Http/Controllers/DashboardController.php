<?php

namespace App\Http\Controllers;

use App\Models\brand;
use App\Models\item;
use App\Models\kategori;
use App\Models\toko;
use Carbon\Carbon;  

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['brand', 'kategori', 'toko'])->latest();

        // Filter pencarian berdasarkan nama item
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $items = $query->paginate(5)->withQueryString();

        // Data lainnya...
        $totalBrands = Brand::count();
        $totalCategories = Kategori::count();
        $totalItems = Item::count();
        $totalTokos = Toko::count();
        $totalHargaItems = Item::sum('harga');
        $totalOngkir = Item::sum('ongkir');

        $tanggalBatas = Carbon::now()->subDays(5);

        $recentBrands = brand::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentCategories = kategori::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentTokos = toko::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentItems = item::where('created_at', '>=', $tanggalBatas)->latest()->get();

        $totalRecent = $recentBrands->count() + $recentCategories->count() + $recentTokos->count() + $recentItems->count();

        return view('dashboard', compact(
            'totalBrands',
            'totalCategories',
            'totalItems',
            'totalTokos',
            'totalHargaItems',
            'totalOngkir',
            'items',
            'recentBrands',
            'recentCategories',
            'recentTokos',
            'recentItems',
            'totalRecent'
        ));
    }

public function cetakPDF()
    {
        $items = Item::with(['toko', 'brand', 'kategori', 'color'])->get();

        $pdf = Pdf::loadView('master.pdf', compact('items'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('dashboard-items.pdf');
    }

    
}
