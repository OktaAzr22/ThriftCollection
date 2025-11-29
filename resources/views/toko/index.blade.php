@extends('layouts.app')

@section('title', 'Data Toko')

@section('content')

<div class="bg-white rounded-lg shadow p-6 mb-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h2 class="text-lg font-bold text-gray-900">Data Pengiriman</h2>

        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <form method="GET" action="{{ route('toko.index') }}">
                <div class="relative">
                    <input type="text" 
                        name="search" 
                        value="{{ old('search', $search) }}"
                        placeholder="Cari nama toko..." 
                        class="px-4 py-2 text-sm border border-gray-300 rounded-lg sm:w-64">

                    @if(request('search'))
                        <button type="button" onclick="clearSearch()" 
                                class="absolute text-gray-400 right-2 top-2 hover:text-gray-600">
                            ✕
                        </button>
                    @endif
                </div>
            </form>

            <button onclick="openModal('modalTambahToko')" 
                    class="px-3 py-2 bg-primary text-white rounded-lg">
                + Tambah Toko
            </button>
        </div>
    </div>

    {{-- Info hasil pencarian --}}
    @if(request('search'))
        <div class="mb-4 text-sm text-gray-700">
            Hasil pencarian untuk: 
            <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
        </div>
    @endif

    {{-- Tabel --}}
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

            <tbody class="bg-white divide-y divide-gray-200">
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
                                {{-- tombol edit --}}
                                <button onclick="openModal('modalEditToko{{ $toko->id }}')" 
                                        class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-edit"></i>
                                </button>

                                {{-- tombol delete --}}
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

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Toko</label>
        <input type="text" name="nama"
            class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('nama') }}" required>
        @error('nama') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Asal Toko</label>
        <input type="text" name="asal"
            class="w-full px-3 py-2 border rounded-lg"
            value="{{ old('asal') }}" required>
        @error('asal') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
        <textarea name="deskripsi" rows="3"
            class="w-full px-3 py-2 border rounded-lg">{{ old('deskripsi') }}</textarea>
        @error('deskripsi') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
    </div>
</x-modal>



{{-- AUTO OPEN MODAL --}}
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

    <div class="mb-4">
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
        <textarea name="deskripsi" rows="3"
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
