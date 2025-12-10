<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $allowedSorts = ['nama', 'harga', 'ongkir', 'tanggal'];
        $sort = $request->get('sort');
        $direction = $request->get('direction') === 'desc' ? 'desc' : 'asc';

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $items = $query->with(['kategori', 'brand', 'toko'])
                    ->paginate(5)
                    ->withQueryString();

        $kategori = Kategori::all();
        $brand = Brand::all();
        $toko = Toko::all();
        $colors = Color::all();

        return view('items.index', compact('items', 'kategori', 'brand', 'toko', 'sort', 'direction', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $tokos = Toko::all();
        $kategoris = Kategori::all();
        $colors = Color::all();
        
        return view('items.create', compact('brands', 'tokos', 'kategoris', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'ongkir' => 'nullable|numeric|min:0',
            'toko_id' => 'required|exists:tokos,id',
            'brand_id' => 'required|exists:brands,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048',
            'id_color' => 'nullable|exists:colors,id_color',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'nullable|date',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('items', 'public');
        }

        Item::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'ongkir' => $request->ongkir ?? 0,
            'toko_id' => $request->toko_id,
            'brand_id' => $request->brand_id,
            'kategori_id' => $request->kategori_id,
            'id_color' => $request->id_color,
            'gambar' => $gambarPath,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal ?? Carbon::now(),
        ]);

        return redirect()->route('items.index')->with('success', 'Items berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit-drawer', [
            'item' => $item,
            'tokos' => Toko::all(),
            'brands' => Brand::all(),
            'kategoris' => Kategori::all(),
            'colors' => Color::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'nama'        => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'ongkir'      => 'nullable|numeric|min:0',
            'toko_id'     => 'required|exists:tokos,id',
            'brand_id'    => 'required|exists:brands,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'id_color'    => 'nullable|exists:colors,id_color',
            'gambar'      => 'nullable|image|max:2048',
            'deskripsi'   => 'nullable|string',
            'tanggal'     => 'nullable|date',
        ]);

        if ($request->filled('hapus_gambar') && $item->gambar) {
            Storage::disk('public')->delete($item->gambar);
            $data['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }

            $namaFile = Str::slug($data['nama']) . '_' . time() . '.' .
                        $request->file('gambar')->getClientOriginalExtension();

            $data['gambar'] = $request->file('gambar')
                ->storeAs('assets/img/uploads/gambar_item', $namaFile, 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Items berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Item $item)
    {
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }

        $item->delete();

        return redirect()->route('items.index')->with('success', 'Items berhasil dihapus.');
    }

    

    public function ajaxDetail($id)
    {
        $item = Item::with(['kategori','brand','color'])->findOrFail($id);
        $item->total = $item->harga + ($item->ongkir ?? 0);

        return view('partials.item-detail', compact('item'));
    }

}
