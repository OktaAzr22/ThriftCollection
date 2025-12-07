@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-2xl bg-blue-100 text-blue-500 mr-4">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div>
                              <p class="text-2xl font-bold text-gray-900">{{ $totalBrands }}</p>
                                <p class="text-sm font-medium text-gray-500">Total Brand</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                                <i class="fas fa-shopping-cart text-xl"></i>
                            </div>
                            <div>
                              <p class="font-bold text-gray-900">Rp {{ number_format($totalOngkir, 0, ',', '.') }}</p>
                                <p class="text-sm font-medium text-gray-500">Total Ongkir</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalItems }}</p>
                                <p class="text-sm font-medium text-gray-500">Total Item</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                                <i class="fas fa-eye text-xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalHargaItems, 0, ',', '.') }}</p>
                                <p class="text-sm font-medium text-gray-500">Total Harga</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <!-- Item Terbaru Section -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <h2 class="text-lg font-bold text-gray-900">Item Terbaru</h2>
                        <a href="{{ route('dashboard.cetak') }}"  target="_blank"
   class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
   Cetak PDF
</a>
                    </div>
                    
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse  ($items as $item)   
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                @if ($item->gambar)
    <img src="{{ asset('storage/' . $item->gambar) }}"
         alt="{{ $item->nama }}"
         class="h-12 w-12 rounded-md object-cover cursor-pointer hover:opacity-80 transition"
         onclick="showImageModal('{{ asset('storage/' . $item->gambar) }}', '{{ $item->nama }}')">
@else
    <div class="h-12 w-12 rounded-md bg-gray-200 flex items-center justify-center text-xs text-gray-500">
        null
    </div>
@endif


                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-medium text-gray-900">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm text-gray-900">{{ $item->kategori->nama ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <x-brand-badge :brand="$item->brand" />
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $item->toko->asal ?? $item->toko->nama_toko ?? '-' }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="text-sm font-bold text-gray-900">Rp {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</div>
                                    </td>
                                </tr>
                                @empty                    
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">Tidak ADA DATA</td>
              </tr>
              @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{--  --}}
  
  

  

  
      <x-modal 
    id="modalPreviewGambar"
    title=""
    action="#"
    method="GET"
    noFooter="true">

    <div class="flex justify-center">
        <img id="previewImageFull" 
             src="" 
             alt="Preview"
             class="max-w-full max-h-[70vh] rounded-lg mt-4">
    </div>

</x-modal>


      
      <script>
function showImageModal(src, nama) {
    // Set gambar
    document.getElementById('previewImageFull').src = src;

    // Ganti judul modal TANPA edit component
    const modal = document.getElementById('modalPreviewGambar');
    const title = modal.querySelector('h3'); // ambil elemen utk title
    if (title) title.textContent = nama;

    // Buka modal
    openModal('modalPreviewGambar');
}
</script>

                      
           
  
@endsection