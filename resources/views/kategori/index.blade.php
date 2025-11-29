@extends('layouts.app')

@section('content')
<x-confirm-delete />

<div class="bg-white rounded-lg shadow p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-lg font-bold text-gray-900">Daftar Kategori</h2>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">

            {{-- SORT --}}
            <form method="GET" class="flex items-center gap-2">
                <select name="sort" class="border rounded px-2 py-1" onchange="this.form.submit()">
                    <option value="asc"  {{ $sort === 'asc' ? 'selected' : '' }}>A - Z</option>
                    <option value="desc" {{ $sort === 'desc' ? 'selected' : '' }}>Z - A</option>
                </select>
            </form>

            {{-- TOMBOl TAMBAH --}}
            <button onclick="openModal('modalTambahKategori')"
                class="px-3 py-2 bg-primary text-white rounded-lg">
                + Tambah Kategori
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $row)
                <tr>
                    <td class="p-3 border">{{ $row->nama }}</td>
                    <td class="p-3 border">
                        <div class="flex gap-2">

                            {{-- EDIT: buka modal edit --}}
                            <button onclick="openModal('modalEditKategori-{{ $row->id }}')"
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </button>

                          <button 
                              onclick="openDeleteModal(
                                  '{{ route('kategori.destroy', $row->id) }}', 
                                  'kategori', 
                                  '{{ $row->nama }}'
                              )"
                              class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                              Hapus
                          </button>


                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $kategoris->links() }}
        </div>
    </div>
</div>

{{-- ========================================================= --}}
{{-- MODAL TAMBAH KATEGORI --}}
{{-- ========================================================= --}}
<x-modal 
    id="modalTambahKategori"
    title="Tambah Kategori Baru"
    action="{{ route('kategori.store') }}">

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
        <input type="text" name="nama"
            class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('nama') }}" required placeholder="Masukkan Nama Kategori">

        @error('nama') 
            <p class="text-red-500 text-xs">{{ $message }}</p> 
        @enderror
    </div>

</x-modal>

{{-- buka modal sesuai session kalau ada --}}
@if (session('openModal'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        openModal(@json(session('openModal')));
    });
</script>
@endif

{{-- ========================================================= --}}
{{-- MODAL EDIT KATEGORI (Per Row) --}}
{{-- ========================================================= --}}
@foreach($kategoris as $row)
<x-modal 
    id="modalEditKategori-{{ $row->id }}"
    title="Edit Kategori"
    action="{{ route('kategori.update', $row->id) }}"
    method="PUT">

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
        <input type="text" name="nama"
            class="w-full px-3 py-2 border rounded-lg"
            value="{{ $row->nama }}" required>

        @error('nama')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
    </div>

</x-modal>
@endforeach

@endsection
