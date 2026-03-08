@extends('layouts.app')

@section('content')
                <x-modal-ajax id="global-modal" title="Detail Item" />

                <div class="bg-white border border-slate-200 rounded-2xl p-6 mt-2">

                    <div class="flex items-center justify-between mb-6">

                        <h2 class="text-lg font-semibold text-slate-800">
                            Data Item
                        </h2>

                        <div class="flex items-center gap-3">
                            <form method="GET" action="{{ route('items.index') }}" class="relative w-full md:w-64">
                                <input class="w-full pl-10 pr-10 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    type="text"
                                    id="searchInput"
                                    name="search"
                                    value="{{ request('search') }}"
                                    data-skeleton-id="itemSkeleton"
                                    data-table-id="tableBody"
                                    data-base-url="{{ route('items.index') }}"
                                    oninput="startSearchLoading(this); this.form.submit()"
                                    placeholder="Cari item..."
                                >

                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>

                                @if(request('search'))
                                    <button type="button" data-target-input="#searchInput"
                                    data-base-url="{{ route('items.index') }}"
                                    onclick="clearSearch(this)"
                                        class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </form>
                            <a href="{{ route('items.create') }}">
                                <button class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                                    Tambah Toko
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto bg-white border border-slate-200 rounded-2xl mt-5">

                        @if(request('search'))
                            <p class="text-sm text-gray-600 mb-3">
                                Menampilkan hasil untuk: 
                                <span class="font-semibold">"{{ request('search') }}"</span>
                            </p>
                        @endif

                        <table class="w-full text-sm">

                            <thead class="text-slate-500 border-b">

                                <tr class="text-left"> 
                                    <th class="py-3 px-4 font-medium">PRODUK</th>
                                    <th class="py-3 px-3 font-medium w-[90px]">HARGA</th>
                                    <th class="py-3 px-3 font-medium">BRAND</th>
                                    <th class="py-3 px-3 font-medium">STORE</th>
                                    <th class="py-3 px-3 font-medium">KATEGORI</th>
                                    <th class="py-3 px-3 font-medium text-center w-[120px]">ACTION</th>
                                </tr>

                            </thead>

                            <x-skeleton-table id="itemSkeleton" :cols="6" :rows="5" class="mt-6 w-full" />
                            <tbody id="tableBody" class="divide-y divide-slate-100">
                                @if($items->count() > 0)
                                @forelse ($items as $item)
                                <tr class="hover:bg-slate-50 transition">

                                    <td class="py-3 px-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200 flex-shrink-0">

                                                @if ($item->gambar)
                                                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}"> 
                                                @else
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg overflow-hidden border border-gray-200">
                                                        <p>None</p>
                                                    </div>
                                                @endif
                                                
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-slate-800">{{ $item->nama }}</p>
                                                <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3 px-3 font-medium text-slate-800 whitespace-nowrap">Rp {{ number_format($item->harga + $item->ongkir, 0, ',', '.') }}</td>

                                    <td class="py-3 px-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-600 whitespace-nowrap">
                                            {{ $item->brand->name }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-3 text-slate-600 whitespace-nowrap">{{ $item->toko->nama }}</td>

                                    <td class="py-3 px-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-600 whitespace-nowrap">
                                            {{ $item->kategori->nama }}
                                        </span>
                                    </td>

                                    <td class="py-3 px-3">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="openEditDrawer('{{ route('items.edit', $item->id) }}')" title="edit"  class="w-8 h-8 flex items-center justify-center rounded-md bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </button>
                                            <button onclick="bukaModal('global-modal', '{{ url('/item/' . $item->id . '/detail') }}')" title="view"  class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                                <i class="fa-solid fa-pen text-xs"></i>
                                            </button>
                                            <button onclick="openDeleteModal(
                                                '{{ route('items.destroy', $item) }}', 
                                                'item', 
                                                '{{ $item->nama }}'
                                            )" title="delete"  class="w-8 h-8 flex items-center justify-center rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition">
                                                <i class="fa-solid fa-trash text-xs"></i>
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
                    </div>
                    {{ $items->links() }}
                </div>

                <div id="editDrawer" class="fixed inset-0 z-50 overflow-hidden hidden">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/50 transition-opacity duration-300"
                        onclick="closeEditDrawer()"></div>

                    <!-- Drawer Panel -->
                    <div class="absolute right-0 top-0 h-full w-full md:w-[600px] bg-white shadow-2xl 
                                transform translate-x-full transition-transform duration-300 ease-in-out
                                flex flex-col"
                        id="editDrawerPanel">

                        <!-- Header -->
                        <div class="flex-shrink-0 flex justify-between items-center p-4 md:p-6 border-b border-gray-200">
                            <h2 class="text-lg md:text-xl font-bold text-gray-800">Edit Item</h2>
                            <button onclick="closeEditDrawer()" 
                                    class="text-gray-600 hover:text-red-500 text-xl md:text-2xl p-1 hover:bg-gray-100 rounded-full transition-colors duration-200">
                                ✕
                            </button>
                        </div>

                        <!-- AJAX Loaded Content -->
                        <div id="editDrawerContent" class="flex-1 overflow-y-auto p-4 md:p-6">
                            <!-- Loading State -->
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-3"></div>
                                    <p class="text-gray-500 text-sm">Memuat form...</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <script>
                function openEditDrawer(url) {
                    const drawer = document.getElementById("editDrawer");
                    const panel = document.getElementById("editDrawerPanel");
                    const content = document.getElementById("editDrawerContent");

                    // Reset scroll position
                    content.scrollTop = 0;
                    
                    // Tampilkan drawer dengan animasi
                    drawer.classList.remove("hidden");
                    setTimeout(() => panel.classList.remove("translate-x-full"), 10);

                    // Tampilkan loading state
                    content.innerHTML = `
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-3"></div>
                                <p class="text-gray-500 text-sm">Memuat form...</p>
                            </div>
                        </div>
                    `;

                    // Fetch data
                    fetch(url)
                        .then(res => {
                            if (!res.ok) throw new Error('Network response was not ok');
                            return res.text();
                        })
                        .then(html => {
                            content.innerHTML = html;
                            // Prevent form submission dari menutup drawer
                            const form = content.querySelector('form');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    // Optional: bisa tambahkan AJAX form submission di sini
                                    // atau biarkan form submit seperti biasa
                                });
                            }
                        })
                        .catch(() => {
                            content.innerHTML = `
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center p-4">
                                        <div class="text-red-500 text-4xl mb-3">⚠️</div>
                                        <p class="text-red-600 font-medium mb-2">Error memuat form</p>
                                        <p class="text-gray-500 text-sm mb-4">Coba refresh halaman atau cek koneksi internet</p>
                                        <button onclick="closeEditDrawer()" 
                                                class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            `;
                        });
                }

                function closeEditDrawer() {
                    const drawer = document.getElementById("editDrawer");
                    const panel = document.getElementById("editDrawerPanel");
                    panel.classList.add("translate-x-full");
                    setTimeout(() => {
                        drawer.classList.add("hidden");
                        // Clear content setelah drawer tertutup
                        document.getElementById("editDrawerContent").innerHTML = `
                            <div class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-3"></div>
                                    <p class="text-gray-500 text-sm">Memuat form...</p>
                                </div>
                            </div>
                        `;
                    }, 300);
                }

                // Close drawer dengan tombol ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !document.getElementById("editDrawer").classList.contains("hidden")) {
                        closeEditDrawer();
                    }
                });
                </script>

@endsection