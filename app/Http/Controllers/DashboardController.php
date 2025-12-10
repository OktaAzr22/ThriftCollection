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
        $query = Item::with(['brand', 'kategori', 'toko']);

        // ==========================
        // SORT PRODUK (nama)
        // ==========================
        if ($request->sort === 'nama_asc') {
            $query->orderBy('nama', 'asc');
        } elseif ($request->sort === 'nama_desc') {
            $query->orderBy('nama', 'desc');
        }

        // ==========================
        // SORT HARGA
        // ==========================
        if ($request->harga === 'harga_asc') {
            $query->orderBy('harga', 'asc');
        } elseif ($request->harga === 'harga_desc') {
            $query->orderBy('harga', 'desc');
        }

        // ==========================
        // SORT DEFAULT (created_at)
        // ==========================
        if (!$request->sort && !$request->harga) {
            // default terbaru
            $query->orderBy('created_at', 'desc');
        }

        // ==========================
        // FILTER KATEGORI
        // ==========================
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        // ==========================
        // FILTER BRAND
        // ==========================
        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }

        // ==========================
        // FILTER SEARCH
        // ==========================
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $items = $query->paginate(5)->withQueryString();

        // ==========================
        // DATA STATISTIK
        // ==========================
        $totalBrands = Brand::count();
        $totalCategories = Kategori::count();
        $totalItems = Item::count();
        $totalTokos = Toko::count();
        $totalHargaItems = Item::sum('harga');
        $totalOngkir = Item::sum('ongkir');

        $tanggalBatas = Carbon::now()->subDays(5);

        $recentBrands = Brand::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentCategories = Kategori::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentTokos = Toko::where('created_at', '>=', $tanggalBatas)->latest()->get();
        $recentItems = Item::where('created_at', '>=', $tanggalBatas)->latest()->get();

        $totalRecent = 
            $recentBrands->count() +
            $recentCategories->count() +
            $recentTokos->count() +
            $recentItems->count();

        $brands = Brand::all();
        $kategoris = Kategori::all();

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
            'totalRecent',
            'brands',
            'kategoris'
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