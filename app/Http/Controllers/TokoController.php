<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use Illuminate\Database\QueryException;

class TokoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Toko::withMax('items', 'ongkir');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $tokos = $query->orderByDesc('items_max_ongkir')->paginate(5)->withQueryString();

        return view('toko.index', compact('tokos', 'search'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|min:3|unique:tokos,nama',
                'asal' => 'required|string|min:3',
                'deskripsi' => 'nullable|string',
            ]);

            Toko::create($validated);

            return redirect()->back()->with('success', 'Toko berhasil ditambahkan.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('openModal', 'modalTambahToko');
        }
    }


    public function update(Request $request, Toko $toko)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|min:3|unique:tokos,nama,' . $toko->id,
                'asal' => 'required|string|min:3',
                'deskripsi' => 'nullable|string',
            ]);

            $toko->update($validated);

            return redirect()->back()->with('success', 'Toko berhasil diperbaruhi.');
        } 
        catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('openModal', 'modalEditToko'.$toko->id);
        }
    }

    public function destroy(Toko $toko)
    {
        try {
            $toko->delete();

            return redirect()->back()->with('success', 'Toko berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Toko tidak bisa dihapus karena masih digunakan oleh item.');
        }
    }
}
