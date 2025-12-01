@extends('layouts.app')

@section('content')

<x-item-modal />

<div class="bg-white rounded-xl shadow-soft p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Data Produk</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola produk thrift Anda di sini</p>
        </div>
        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>

            <a href="{{ route('items.create') }}">
                    <button class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-blue-700 transition-all duration-200 flex items-center justify-center shadow-md hover-lift">
                        <i class="fas fa-plus mr-2"></i> Tambah Produk   
                    </button> 
            </a>
        </div>
    </div>
                    
    <div class="overflow-x-auto rounded-lg custom-scrollbar">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Store</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($items as $item)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-4 py-4">
                        <div class="flex items-center">
                                            
                            @if ($item->gambar)
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200">
                                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                                </div>
                            @else
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200">
                                    <p>None</p>
                                </div>
                            @endif
                                                
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex items-center">
                            <div class="h-6 w-6 rounded-full bg-red-100 flex items-center justify-center mr-2">
                                <i class="fas fa-tag text-red-500 text-xs"></i>
                            </div>
                            <div class="text-sm text-gray-900">{{ $item->brand->name }}</div>
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="text-sm text-gray-900">{{ $item->toko->nama }}</div>
                    </td>
                    <td class="px-4 py-4">
                        <span class="px-2.5 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Terbatas</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex space-x-2">
                            <button class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors duration-200" title="show"  
                                    onclick="openItemModal({{ $item->id }})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors duration-200" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-4 text-sm text-center text-gray-500">
                            No items found. <a href="{{ route('items.create') }}" class="text-blue-500 hover:text-blue-700">Add your first item</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
                    
    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Menampilkan <span class="font-medium">1</span> hingga <span class="font-medium">5</span> dari <span class="font-medium">24</span> hasil
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1.5 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Sebelumnya
            </button>
            <button class="px-3 py-1.5 text-sm font-medium text-white bg-primary border border-transparent rounded-lg">
                1
            </button>
            <button class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                2
            </button>
            <button class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                Selanjutnya
            </button>
        </div>
    </div>
</div> 
@endsection