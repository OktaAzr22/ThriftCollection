    @extends('layouts.app')

    @section('content')

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                  <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:shadow-lg transition">
                      <div class="flex items-center gap-4">
                          <div class="p-3 bg-blue-100 rounded-xl">
                              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                              </svg>
                          </div>
                          <div>
                              <p class="text-sm font-medium text-slate-500">Total Brand</p>
                              <p class="text-lg font-semibold text-slate-800 mt-1">{{ $totalBrands }}</p>
                          </div>
                      </div>
                  </div>

                  <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:shadow-lg transition">
                      <div class="flex items-center gap-4">
                          <div class="p-3 bg-green-100 rounded-xl">
                              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                          </div>
                          <div>
                              <p class="text-sm font-medium text-slate-500">Total Ongkir</p>
                              <p class=" text-lg font-semibold text-emerald-600 mt-1"> Rp {{ number_format($totalOngkir, 0, ',', '.') }}</p>
                          </div>
                      </div>
                  </div>

                  <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:shadow-lg transition">
                      <div class="flex items-center gap-4">
                          <div class="p-3 bg-yellow-100 rounded-xl">
                              <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                              </svg>
                          </div>
                          <div>
                              <p class="text-sm font-medium text-slate-500">Total Item</p>
                              <p class="text-lg font-semibold text-slate-800 mt-1">{{ $totalItems }}</p>
                          </div>
                      </div>
                  </div>

                  <div class="bg-white p-6 rounded-2xl border border-slate-200 hover:shadow-lg transition">
                      <div class="flex items-center gap-4">
                          <div class="p-3 bg-purple-100 rounded-xl">
                              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                              </svg>
                          </div>
                          <div>
                              <p class="text-sm font-medium text-slate-500">Total Harga</p>
                              <p class="text-lg font-semibold text-slate-800 mt-1">Rp {{ number_format($totalHargaItems, 0, ',', '.') }}</p>
                          </div>
                      </div>
                  </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-2xl p-6 mt-2">
                    <div class="flex items-center justify-between mb-6">

                        <h2 class="text-lg font-semibold text-slate-800">
                            Data Item
                        </h2>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('dashboard.cetak') }}"target="_blank">
                                <button class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                                Cetak
                            </button>
                            </a>
                        </div>
                    </div>
                    

                    

                    

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-slate-500 border-b border-slate-200">
                            <tr class="text-left">
                                <th class="py-3 cursor-pointer select-none">Produk</th>
                                <th class="py-3">HARGA</th>
                                <th class="py-3">KATEGORI</th>
                                <th class="py-3">BRAND</th>
                                <th class="py-3">ASAL</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($items as $item)
                                <tr class="hover:bg-slate-50">
                                    <td class="py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0">
                                                @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->nama }}"
                                                    onclick="showImageModal('{{ asset('storage/' . $item->gambar) }}', '{{ $item->nama }}')"
                                                    class="w-full h-full object-cover">
                                                @else
                                                    <div class="h-12 w-12 rounded-md bg-gray-200 flex items-center justify-center text-xs text-gray-500">
                                                        null
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-800">{{ $item->nama }}</p>
                                                <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 font-medium">{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-full text-xs">{{ $item->kategori->nama ?? '-' }}</span>
                                    </td>
                                    <td class="py-3"><x-brand-badge :brand="$item->brand" /></td>
                                    <td class="py-3">{{ $item->toko->asal ?? $item->toko->nama_toko ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        Data tidak ada
                                    </td>
                                </tr>
                            @endforelse

                            
                        </tbody>
                    </table>
                </div>

                {{ $items->links() }}
            </div>


        


       

       


        <script>
            

            

            
           

            function showImageModal(src, nama) {
                document.getElementById('previewImageFull').src = src;

                const modal = document.getElementById('modalPreviewGambar');
                const title = modal?.querySelector('h3');
                if (title) title.textContent = nama;

                if (typeof openModal === 'function') {
                    openModal('modalPreviewGambar');
                }
            }
        </script>

        <x-modal id="modalPreviewGambar" title="" action="#" method="GET" noFooter="true">
            <div class="flex justify-center">
                <img id="previewImageFull" src="" alt="Preview"
                    class="max-w-full max-h-[70vh] rounded-lg mt-4">
            </div>
        </x-modal>
    @endsection