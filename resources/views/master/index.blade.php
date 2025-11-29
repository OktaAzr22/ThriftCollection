@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-lg font-bold text-gray-900 mb-6">Manajemen Data</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- =======================
            TABLE KATEGORI
        ======================== --}}
        <div>
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-md font-semibold text-gray-800">Kategori</h3>

                <button onclick="openModal('modalTambahKategori')"
                    class="px-3 py-1 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </button>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Kategori
                </th>

                {{-- Kolom aksi rata tengah --}}
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($kategoris as $kategori)
                <tr class="hover:bg-gray-50 transition-colors duration-150">

                    <td class="px-4 py-3">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $kategori->nama }}
                        </div>
                    </td>

                    {{-- Aksi di tengah --}}
                    <td class="px-4 py-3">
                        <div class="flex justify-center space-x-3">

                            {{-- Edit --}}
                            <button onclick="openModal('modalEditKategori-{{ $kategori->id }}')"
                                class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Delete --}}
                            <button onclick="openDeleteModal(
                                    '{{ route('master.kategori.destroy', $kategori->id) }}',
                                    'kategori',
                                    '{{ $kategori->nama }}'
                                )"
                                class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition-colors duration-200">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>
</div>

        </div>

        {{-- =======================
            TABLE WARNA
        ======================== --}}
        <div>

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-md font-semibold text-gray-800">Warna</h3>

                <button onclick="openModal('modalTambahWarna')"
                    class="px-3 py-1 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah
                </button>
            </div>

            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3"></th>

                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Warna
                            </th>

                            {{-- Kolom Aksi rata tengah --}}
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($colors as $color)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">

                                {{-- Kolom Bagan Warna --}}
                                <td class="px-4 py-3">
                                    <div class="w-6 h-6 rounded border border-gray-300"
                                        style="background: {{ $color->hex }}"></div>
                                </td>

                                {{-- Nama Warna --}}
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $color->nama }}
                                    </div>
                                </td>

                                {{-- Aksi di tengah --}}
                                <td class="px-4 py-3">
                                    <div class="flex justify-center space-x-3">

                                        {{-- Edit --}}
                                        <button onclick="openModal('modalEditWarna-{{ $color->id_color }}')"
                                            class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition-colors duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Delete --}}
                                        <button onclick="openDeleteModal(
                                                '{{ route('master.color.destroy', $color->id_color) }}',
                                                'warna',
                                                '{{ $color->nama }}'
                                            )"
                                            class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition-colors duration-200">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>

    </div>
</div>


{{-- ========================================================= --}}
{{-- MODAL TAMBAH WARNA --}}
{{-- ========================================================= --}}
<x-modal id="modalTambahWarna" title="Tambah Warna Baru" action="{{ route('master.color.store') }}">

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Nama Warna</label>

        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('nama') }}" required placeholder="Masukkan Nama Warna">

        @error('nama')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-2">Pilih Warna</label>

        <input type="color" name="hex" class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('hex', '#000000') }}">

        @error('hex')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
    </div>

</x-modal>


{{-- ========================================================= --}}
{{-- MODAL EDIT WARNA --}}
{{-- ========================================================= --}}
@foreach ($colors as $color)
    <x-modal id="modalEditWarna-{{ $color->id_color }}" title="Edit Warna"
        action="{{ route('master.color.update', $color->id_color) }}" method="PUT">

        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Nama Warna</label>
            <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg"
                value="{{ $color->nama }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Pilih Warna</label>
            <input type="color" name="hex" class="w-full px-3 py-2 border rounded-lg"
                value="{{ $color->hex }}" required>
        </div>

    </x-modal>
@endforeach


{{-- ========================================================= --}}
{{-- MODAL TAMBAH KATEGORI --}}
{{-- ========================================================= --}}
<x-modal id="modalTambahKategori" title="Tambah Kategori Baru" action="{{ route('master.kategori.store') }}">

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>

        <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('nama') }}" required placeholder="Masukkan Nama Kategori">

        @error('nama')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror
    </div>

</x-modal>


{{-- ========================================================= --}}
{{-- MODAL EDIT KATEGORI --}}
{{-- ========================================================= --}}
@foreach ($kategoris as $kategori)
    <x-modal id="modalEditKategori-{{ $kategori->id }}" title="Edit Kategori"
        action="{{ route('master.kategori.update', $kategori->id) }}" method="PUT">

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
            <input type="text" name="nama" class="w-full px-3 py-2 border rounded-lg"
                value="{{ $kategori->nama }}" required>
        </div>

    </x-modal>
@endforeach


{{-- ========================================================= --}}
{{-- AUTO OPEN MODAL (VALIDASI / ERROR) --}}
{{-- ========================================================= --}}
@if (session('openModal'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            openModal(@json(session('openModal')));
        });
    </script>
@endif

@endsection
