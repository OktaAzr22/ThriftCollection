@extends('layouts.app')

@section('title', 'Data Toko')

@section('content')

<div class="bg-white rounded-lg shadow p-6 mb-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-lg font-bold text-gray-900">Data Pengiriman</h2>
        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
            <form method="GET" action="{{ route('toko.index') }}" class="relative flex justify-end w-full md:w-auto">
                <input class="px-10 py-2 text-sm border border-gray-300 rounded-lg bg-white  focus:outline-none focus:ring-0  focus:border-primary transition-all duration-300 ease-in-out w-4/5 md:w-48 origin-right focus:w-full md:focus:w-64" 
                    type="text"
                    id="searchInput"
                    name="search"
                    value="{{ request('search') }}"
                    data-skeleton-id="tokoSkeleton"
                    data-table-id="tableBody"
                    data-base-url="{{ route('toko.index') }}"
                    oninput="startSearchLoading(this); this.form.submit()"
                    placeholder="Cari data..."
                >

                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

                @if(request('search'))
                    <button type="button" data-target-input="#searchInput"
                    data-base-url="{{ route('toko.index') }}"
                    onclick="clearSearch(this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
                        <i class="fas fa-times"></i>
                    </button>
                @endif
            </form>

            <button onclick="openModal('modalTambahToko')" 
                    class="px-3 py-2 bg-primary text-white rounded-lg">
                + Tambah Toko
            </button>
        </div>
    </div>

    @if(request('search'))
        <div class="mb-4 text-sm text-gray-700">
            Hasil pencarian untuk: 
            <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ongkir</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>

            <x-skeleton-table id="tokoSkeleton" :cols="5" :rows="1" class="mt-6 w-full" />

            <tbody id="tableBody"  class="bg-white divide-y divide-gray-200">
                @if($tokos->count() > 0)
                    @forelse ($tokos as $toko)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $toko->nama }}</div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-900">{{ $toko->asal }}</div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">
                                    {{ $toko->deskripsi ?? '-' }}
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ number_format($toko->items_max_ongkir ?? 0, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-4 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openModal('modalEditToko{{ $toko->id }}')" 
                                            class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button onclick="openDeleteModal(
                                                '{{ route('toko.destroy', $toko->id) }}', 
                                                'toko', 
                                                '{{ $toko->nama }}'
                                            )"
                                            class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data toko.</td></tr>
                    @endforelse
                @else
                    <tr>
                        <td colspan="5" class="py-4 text-center text-red-500 font-semibold">
                            ⚠️ Data tidak ditemukan untuk pencarian:
                            "<span class="font-bold">{{ request('search') }}</span>"
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-4">
            {{ $tokos->links() }}
        </div>
    </div>
</div>


{{-- ===================== --}}
{{-- MODAL TAMBAH TOKO --}}
{{-- ===================== --}}
<x-modal 
    id="modalTambahToko"
    title="Tambah Toko Baru"
    action="{{ route('toko.store') }}">

    <div class="mb-4 mt-3">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Toko</label>
        <input type="text" name="nama"
            class="w-full px-3 py-2 border rounded-lg" placeholder="Masukkan Nama Toko.."
            value="{{ old('nama') }}" required>
        @error('nama') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Asal Toko</label>
        <input type="text" name="asal"
            class="w-full px-3 py-2 border rounded-lg" placeholder="Masukkan Asal..."
            value="{{ old('asal') }}" required>
        @error('asal') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" rows="3" placeholder="Masukkan Deskripsi Toko..."
            class="w-full px-3 py-2 border rounded-lg">{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>
    {{--  --}}
    
    {{--  --}}
</x-modal>

@if (session('openModal'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        openModal(@json(session('openModal')));
    });
</script>
@endif


{{-- ===================== --}}
{{-- MODAL EDIT PER TOKO --}}
{{-- ===================== --}}
@foreach($tokos as $toko)
<x-modal 
    id="modalEditToko{{ $toko->id }}"
    title="Edit Data Toko"
    action="{{ route('toko.update', $toko->id) }}"
    method="PUT">

    @php
        $isEditError = session('openModal') === 'modalEditToko'.$toko->id;
    @endphp

    <div class="mb-4 mt-3">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Toko</label>
        <input type="text"
               name="nama"
               class="w-full px-3 py-2 border rounded-lg"
               value="{{ $isEditError ? old('nama') : $toko->nama }}"
               required>
        @if ($isEditError) @error('nama') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror @endif
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Asal</label>
        <input type="text"
               name="asal"
               class="w-full px-3 py-2 border rounded-lg"
               value="{{ $isEditError ? old('asal') : $toko->asal }}"
               required>
        @if ($isEditError) @error('asal') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror @endif
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
        <textarea name="deskripsi" rows="3" placeholder="Deskripsi Toko ..."
            class="w-full px-3 py-2 border rounded-lg">{{ $isEditError ? old('deskripsi') : $toko->deskripsi }}</textarea>
        @if ($isEditError) @error('deskripsi') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror @endif
    </div>

</x-modal>
@endforeach


@endsection


@push('scripts')
<script>
    function clearSearch() {
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        window.location.href = url.toString();
    }
</script>
@endpush
