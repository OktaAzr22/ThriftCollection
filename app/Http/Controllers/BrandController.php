<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $colors = Color::all();

        $brands = Brand::with(['color'])
            ->withCount('items')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('items_count', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('brands.index', compact('brands', 'search', 'colors'));
    }


    

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'  => 'required|string|min:2|max:255',
                'brand_origin' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'id_color' => 'nullable|exists:colors,id_color'
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('brands', 'public');
            }

            Brand::create([
                'name'  => $request->name,
                'brand_origin' =>$request->brand_origin,
                'image' => $imagePath,
                'id_color'      => $request->id_color,
            ]);

            return redirect()->back()->with('success', 'Brand berhasil ditambahkan.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalTambahBrand');
        }
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'brand_origin'  => 'nullable|string|max:255',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_color' => 'nullable|exists:colors,id_color'
        ]);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('brands', 'public');
        }

        $brand->update([
            'name'          => $request->name,
            'brand_origin'  => $request->brand_origin,
            'image'         => $imagePath,
            'id_color' => $request->id_color,
        ]);

        return redirect()->back()->with('success', 'Brand berhasil diperbarui.');
    }


    public function destroy(Brand $brand)
    {
        try {
            if ($brand->image) {
                Storage::disk('public')->delete($brand->image);
            }

            $brand->delete();

            return redirect()->route('brands.index')->with('success', 'Brand berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('brands.index')->with('error', 'Brand tidak bisa dihapus karena masih digunakan oleh item.');
        }
    }

    public function ajaxItems($id)
{
    $brand = Brand::findOrFail($id);
    $items = $brand->items()->get();

    return view('partials.brand-items', compact('brand', 'items'));
}

   
}

