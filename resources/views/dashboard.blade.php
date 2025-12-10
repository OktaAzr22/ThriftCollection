    @extends('layouts.app')

    @section('content')

        @php
            $currentSort = request('sort');

            $nextProdukSort = ($currentSort === 'terlama') ? 'terbaru' : 'terlama';

            $nextHargaSort = ($currentSort === 'harga_tertinggi') ? 'harga_terendah' : 'harga_tertinggi';
        @endphp


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 transition-colors">
                <div class="flex items-center">
                    <div class="p-3 rounded-2xl bg-blue-100 dark:bg-blue-900/40 text-blue-500 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalBrands }}</p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Brand</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 transition-colors">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/40 text-green-500 mr-4">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 dark:text-gray-100">
                            Rp {{ number_format($totalOngkir, 0, ',', '.') }}
                        </p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Ongkir</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 transition-colors">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-yellow-500 mr-4">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $totalItems }}</p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Item</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 transition-colors">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/40 text-purple-500 mr-4">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            Rp {{ number_format($totalHargaItems, 0, ',', '.') }}
                        </p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Harga</p>
                    </div>
                </div>
            </div>

        </div>


        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-bold text-gray-900">Item Terbaru</h2>

                    @if(request('sort') || request('kategori') || request('brand') || request('search'))
                        <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">
                            Filter aktif
                        </span>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('dashboard.cetak') }}" target="_blank"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Cetak PDF
                    </a>

                    @if(request('sort') || request('kategori') || request('brand') || request('search'))
                        <a href="{{ url()->current() }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300"
                        onclick="showLoading()">
                            Clear Filter
                        </a>
                    @endif

                </div>
            </div>

            <div id="realContent" class="overflow-x-auto rounded-lg mt-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => $nextProdukSort]) }}"
                                class="cursor-pointer select-none"
                                onclick="showLoading()">
                                    Produk ▾
                                </a>
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => $nextHargaSort]) }}"
                                class="cursor-pointer select-none"
                                onclick="showLoading()">
                                    Harga ▾
                                </a>
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <button type="button"
                                        class="cursor-pointer select-none"
                                        onclick="openKategoriPopup()">
                                    Kategori ▾
                                </button>
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                <button type="button"
                                        class="cursor-pointer select-none"
                                        onclick="openBrandPopup()">
                                    Brand ▾
                                </button>
                            </th>

                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Asal
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($items as $item)
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
                                            <div class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-4 text-sm text-gray-900">
                                    {{ $item->kategori->nama ?? '-' }}
                                </td>

                                <td class="px-4 py-4">
                                    <x-brand-badge :brand="$item->brand" />
                                </td>

                                <td class="px-4 py-4 text-sm text-gray-900">
                                    {{ $item->toko->asal ?? $item->toko->nama_toko ?? '-' }}
                                </td>
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

            <div class="mt-6">
                {{ $items->links() }}
            </div>
        </div>

        <div id="skeletonWrapper" class="hidden">
            <div class="bg-white rounded-lg shadow p-6 animate-pulse">
                <div class="h-5 w-44 bg-gray-200 rounded mb-5"></div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                @for ($i = 0; $i < 5; $i++)
                                    <th class="px-4 py-3">
                                        <div class="h-4 w-24 bg-gray-200 rounded"></div>
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($r = 0; $r < 6; $r++)
                                <tr>
                                    @for ($c = 0; $c < 5; $c++)
                                        <td class="px-4 py-4">
                                            <div class="h-4 w-full bg-gray-200 rounded"></div>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="kategoriPopup" class="fixed inset-0 bg-black/40 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-80">
                <h3 class="text-lg font-semibold mb-3">Pilih Kategori</h3>

                <ul class="space-y-2">
                    @foreach ($kategoris as $kat)
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['kategori' => $kat->id]) }}"
                            class="block px-3 py-2 rounded hover:bg-gray-100"
                            onclick="showLoading()">
                                {{ $kat->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <button type="button"
                        class="mt-4 w-full py-2 bg-gray-200 rounded"
                        onclick="closePopup('kategoriPopup')">
                    Tutup
                </button>
            </div>
        </div>

        <div id="brandPopup" class="fixed inset-0 bg-black/40 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-80">
                <h3 class="text-lg font-semibold mb-3">Pilih Brand</h3>

                <ul class="space-y-2">
                    @foreach ($brands as $brand)
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['brand' => $brand->id]) }}"
                            class="block px-3 py-2 rounded hover:bg-gray-100"
                            onclick="showLoading()">
                                {{ $brand->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <button type="button"
                        class="mt-4 w-full py-2 bg-gray-200 rounded"
                        onclick="closePopup('brandPopup')">
                    Tutup
                </button>
            </div>
        </div>

        <script>
            function showLoading() {
                document.getElementById('realContent')?.classList.add('hidden');
                document.getElementById('skeletonWrapper')?.classList.remove('hidden');
            }

            window.addEventListener('load', () => {
                document.getElementById('skeletonWrapper')?.classList.add('hidden');
                document.getElementById('realContent')?.classList.remove('hidden');
            });

            function openKategoriPopup() {
                document.getElementById('kategoriPopup')?.classList.remove('hidden');
            }

            function openBrandPopup() {
                document.getElementById('brandPopup')?.classList.remove('hidden');
            }

            function closePopup(popupId) {
                document.getElementById(popupId)?.classList.add('hidden');
            }

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