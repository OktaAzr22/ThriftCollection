@extends('layouts.app')

@section('content')
                  <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h2 class="text-lg font-bold text-gray-900">Data Produk</h2>
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <div class="relative w-full md:w-64">
                                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <a href="{{ route('items.create') }}">
                              <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Produk
                              </button>
                            </a>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Store</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($items as $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                          @if ($item->gambar)
                                            <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                                            </div>
                                          @else
                                            <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                                                <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1544022613-e87ca75a784a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Jaket Denim Vintage">
                                            </div>
                                          @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-medium text-gray-900">Rp{{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $item->brand->name }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $item->toko->nama }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-green-600 hover:text-green-900 transition-colors duration-200" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Delete">
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
                </div>

                
@endsection