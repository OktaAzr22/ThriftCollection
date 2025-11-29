<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama', $request->get('sort', 'asc'))
                             ->paginate(5);


        return view('kategori.index', [
            'kategoris' => $kategoris,
            'sort' => $request->get('sort', 'asc')
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required','min:3','max:255', Rule::unique('kategoris','nama')],
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.min' => 'Nama kategori minimal 3 karakter',
            'nama.max' => 'Nama kategori maksimal 255 karakter',
            'nama.unique' => 'Nama kategori sudah ada di database',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput()
                            ->with('openModal', 'modalTambahKategori');
        }

        Kategori::create($request->only('nama'));

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

public function update(Request $request, Kategori $kategori)
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
        // buka modal edit spesifik untuk ID kategori ini
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('openModal', 'modalEditKategori-' . $kategori->id);
    }

    $kategori->update(['nama' => $request->nama]);

    return redirect()->back()->with('success', 'Kategori berhasil diperbaruhi.');
}


    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();

            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('alert', [
                'type'    => 'error',
                'message' => 'Kategori tidak bisa dihapus karena masih digunakan oleh item.',
                'timeout' => 5000,
            ]);
        }
    }
}
