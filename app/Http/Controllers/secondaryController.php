<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class secondaryController extends Controller
{
    public function index(Request $request)
    {
        return view('master.index', [
            'kategoris' => Kategori::orderBy('nama', 'asc')->get(),
            'colors'    => Color::orderBy('nama', 'asc')->get(),
        ]);
    }

    public function storeKategori(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3|unique:kategoris,nama'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('openModal', 'modalTambahKategori'); 
        }

        Kategori::create([
            'nama' => $request->nama
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function updateKategori(Request $request, Kategori $kategori)
    {
        $validator = Validator::make($request->all(), [
        'nama' => ['required','min:1','max:255', Rule::unique('kategoris','nama')->ignore($kategori->id)],
    ], [
        'nama.required' => 'Nama kategori wajib diisi',
        'nama.min' => 'Nama kategori minimal 1 karakter',
        'nama.max' => 'Nama kategori maksimal 255 karakter',
        'nama.unique' => 'Nama kategori sudah ada di database',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('openModal', 'modalEditKategori-' . $kategori->id);
    }

    $kategori->update(['nama' => $request->nama]);

    return redirect()->back()->with('success', 'Kategori berhasil diperbaruhi.');
    }

    public function deleteKategori(kategori $kategori)
    {
        try {
            $kategori->delete();
            return back()->with('success', 'Kategori berhasil dihapus');
        } catch (QueryException $e) {
            return back()->with('alert', 'Kategori masih digunakan oleh item!');
        }
    }

    public function storeColor(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2|unique:colors,nama',
            'hex'  => 'nullable|string'
        ]);

        Color::create($request->only(['nama', 'hex']));

        return back()->with('success', 'Warna berhasil ditambahkan');
    }

    public function updateColor(Request $request, Color $color)
    {
        $request->validate([
            'nama' => [
                'required',
                Rule::unique('colors', 'nama')->ignore($color->id_color, 'id_color')
            ],
            'hex' => 'nullable|string'
        ]);

        $color->update($request->only(['nama', 'hex']));

        return back()->with('success', 'Warna berhasil diperbarui');
                    
    }

    public function deleteColor(Color $color)
    {
        $color->delete();
        return back()->with('success', 'Warna berhasil dihapus');
    }
}
