@extends('layouts.app')

@section('content')

                @if ($errors->any())

                    <script>

                        document.addEventListener("DOMContentLoaded",()=>openModal('modalTambahBrand'));

                    </script>

                @endif

                <div class="bg-white dark:bg-black border border-slate-200 dark:border-purple-500/20 rounded-2xl p-6 mt-2">

                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-white">
                            Data Pengiriman
                        </h2>
                        <div class="flex items-center gap-3">
                            <form method="GET" action="{{ route('brands.index') }}" 
                                class="relative flex justify-end w-full md:w-auto">

                                <input 
                                    class="px-10 py-2 text-sm border border-gray-300 dark:border-purple-500/30 rounded-lg bg-white dark:bg-black focus:outline-none focus:ring-0 focus:border-primary dark:focus:border-purple-500 transition-all duration-300 ease-in-out w-4/5 md:w-48 origin-right focus:w-full md:focus:w-64 dark:text-white dark:placeholder-white/50"
                                    type="text"
                                    id="searchInput"
                                    name="search"
                                    value="{{ request('search') }}"
                                    data-skeleton-id="brandSkeleton"
                                    data-table-id="tableBody"
                                    data-base-url="{{ route('brands.index') }}"
                                    oninput="startSearchLoading(this); this.form.submit()"
                                    placeholder="Cari brand..."
                                >

                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-purple-400"></i>

                                @if(request('search'))
                                    <button 
                                        type="button"
                                        data-target-input="#searchInput"
                                        data-base-url="{{ route('brands.index') }}"
                                        onclick="clearSearch(this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-purple-400 dark:hover:text-purple-300 cursor-pointer">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </form>
                            <x-button onclick="openModal('modalTambahBrand')">Tambah Brand</x-button>
                        </div>

                    </div>

                    @if(request('search'))
                        <p class="text-sm text-gray-600 dark:text-white/60 mb-3">
                            Menampilkan hasil untuk: 
                            <span class="font-semibold dark:text-white">"{{ request('search') }}"</span>
                        </p>
                    @endif

                    <div class="overflow-x-auto">

                        <table class="w-full text-sm">

                            <thead class="text-slate-500 dark:text-white/60 border-b border-slate-200 dark:border-purple-500/20">

                                <tr class="text-left">
                                    <th class="py-3">Icon</th>
                                    <th class="py-3">Nama</th>
                                    <th class="py-3">Asal</th>
                                    <th class="py-3">Item</th>
                                    <th class="py-3 text-center">ACTION</th>
                                </tr>

                            </thead>

                           <x-skeleton-table id="brandSkeleton" :rows="3">
                            <tr class="border-b dark:border-purple-500/10">
                                <td class="py-3 px-4">
                                    <div class="w-10 h-10 rounded-lg skeleton"></div>
                                </td>

                                <td class="py-3 space-y-2">
                                    <div class="h-4 w-32 rounded skeleton"></div>
                                    <div class="h-3 w-20 rounded skeleton opacity-60"></div>
                                </td>

                                <td class="py-3">
                                    <div class="h-4 w-40 rounded skeleton"></div>
                                </td>

                                <td class="py-3">
                                    <div class="h-4 w-10 rounded skeleton"></div>
                                </td>

                                <td class="py-3">
                                    <div class="flex justify-center gap-2">
                                        <div class="w-8 h-8 rounded-md skeleton"></div>
                                        <div class="w-8 h-8 rounded-md skeleton"></div>
                                        <div class="w-8 h-8 rounded-md skeleton"></div>
                                    </div>
                                </td>
                            </tr>
                           </x-skeleton-table>

                            <tbody class="divide-y divide-slate-200 dark:divide-purple-500/20" id="tableBody">

                                @if($brands->count() > 0)

                                    @foreach($brands as $brand)

                                        <tr class="hover:bg-slate-50 dark:hover:bg-purple-500/10 dark:text-white/80">
                                            <td class="py-3 px-4">
                                                <div class="flex items-center space-x-3">

                                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200 dark:bg-purple-500/20">
                                                        @if($brand->image)
                                                            <img src="{{ asset('storage/' . $brand->image) }}"
                                                                class="w-full h-full object-cover">
                                                        @else
                                                            <span class="text-gray-400 dark:text-white/40">No Image</span>
                                                        @endif
                                                        
                                                    </div>

                                                </div>
                                            </td>

                                            <td class="dark:text-white">{{ $brand->name }}</td>

                                            <td class="dark:text-white/70">{{ $brand->brand_origin }}</td>

                                            <td class="font-medium dark:text-purple-400">{{ $brand->items_count }}</td>

                                            <td class="text-center">

                                                <div class="flex justify-center gap-2">

                                                    <button onclick="bukaModal('global-modal', '/brand/{{ $brand->id }}/items')" class="w-8 h-8 flex items-center justify-center rounded-md bg-slate-100 dark:bg-purple-500/10 text-slate-600 dark:text-purple-400 hover:bg-slate-200 dark:hover:bg-purple-500/20 transition" title="Lihat Detail">
                                                        <i class="fa-solid fa-eye text-xs"></i>
                                                    </button>

                                                    <button title="Edit" onclick="openModal('modalEditBrand-{{ $brand->id }}')" class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-50 dark:bg-purple-500/20 text-blue-600 dark:text-purple-400 hover:bg-blue-100 dark:hover:bg-purple-500/30 transition">
                                                        <i class="fa-solid fa-pen text-xs"></i>
                                                    </button>

                                                    <button onclick="openDeleteModal(
                                                            '{{ route('brands.destroy', $brand->id) }}', 
                                                            'BRAND', 
                                                            '{{ $brand->name }}'
                                                        )" class="w-8 h-8 flex items-center justify-center rounded-md bg-red-50 dark:bg-purple-500/20 text-red-600 dark:text-purple-400 hover:bg-red-100 dark:hover:bg-purple-500/30 transition">
                                                        <i class="fa-solid fa-trash text-xs"></i>
                                                    </button>

                                                </div>

                                            </td>
                                        </tr>

                                    @endforeach

                                @else

                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-red-500 dark:text-purple-400 font-semibold">
                                            ⚠️ Data tidak ditemukan untuk pencarian:
                                            "<span class="font-bold">{{ request('search') }}</span>"
                                        </td>
                                    </tr>

                                @endif

                            </tbody>

                            @foreach ($brands as $brand)
                                <x-modal 
                                    id="modalEditBrand-{{ $brand->id }}"
                                    title="Edit Brand"
                                    action="{{ route('brands.update', $brand->id) }}"
                                    method="PUT">

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Nama Brand</label>
                                        <input type="text" name="name"
                                            class="w-full px-3 py-2 border rounded-lg dark:bg-black dark:border-purple-500/30 dark:text-white dark:placeholder-white/50"
                                            value="{{ old('name', $brand->name) }}" required placeholder="Masukkan Nama Brand">

                                        @error('name') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Asal Brand</label>
                                        <input type="text" name="brand_origin"
                                            class="w-full px-3 py-2 border rounded-lg dark:bg-black dark:border-purple-500/30 dark:text-white dark:placeholder-white/50"
                                            value="{{ old('brand_origin', $brand->brand_origin) }}"
                                            placeholder="Masukkan Asal Brand">

                                        @error('brand_origin') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Warna Brand</label>

                                        <div class="grid grid-cols-2 gap-y-3">
                                            @foreach ($colors as $color)
                                                <label class="flex items-center gap-2 cursor-pointer">

                                                    <input type="radio"
                                                        name="id_color"
                                                        value="{{ $color->id_color }}"
                                                        class="appearance-none w-4 h-4 border border-gray-400 dark:border-white/30 rounded-full 
                                                            checked:border-transparent 
                                                            checked:bg-[{{ $color->hex }}]
                                                            focus:outline-none focus:ring-2 focus:ring-offset-1 dark:focus:ring-purple-500
                                                            transition-all duration-200"
                                                        style="box-shadow: inset 0 0 0 3px white;"
                                                        {{ old('id_color', $brand->id_color) == $color->id_color ? 'checked' : '' }}>

                                                    <span class="text-gray-700 dark:text-white/70 text-sm">{{ $color->nama }}</span>
                                                </label>
                                            @endforeach
                                        </div>

                                        @error('id_color')
                                            <p class="text-red-500 dark:text-purple-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Gambar Brand</label>

                                        <div
                                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 dark:border-purple-500/30
                                                rounded-lg p-6 cursor-pointer hover:border-primary dark:hover:border-purple-500 transition"
                                            onclick="document.getElementById('imageEdit-{{ $brand->id }}').click()"
                                            id="uploadAreaEdit-{{ $brand->id }}"
                                        >
                                            <div id="previewAreaEdit-{{ $brand->id }}" class="text-center">
                                                @if ($brand->image)
                                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                                        class="h-32 rounded-lg mx-auto object-cover mb-3">
                                                @else
                                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-purple-400 mb-3"></i>
                                                    <p class="text-sm text-gray-500 dark:text-white/60">Klik untuk mengunggah gambar</p>
                                                    <p class="text-xs text-gray-400 dark:text-white/40 mt-1">Format JPG/PNG max 2MB</p>
                                                @endif
                                            </div>
                                        </div>

                                        <input type="file"
                                            name="image"
                                            id="imageEdit-{{ $brand->id }}"
                                            class="hidden"
                                            accept="image/*"
                                            onchange="previewEditImage(event, '{{ $brand->id }}')">

                                        <button type="button"
                                                onclick="clearEditImage('{{ $brand->id }}')"
                                                id="deleteImageBtnEdit-{{ $brand->id }}"
                                                class="mt-3 px-3 py-1 bg-red-500 dark:bg-purple-500 text-white rounded {{ $brand->image ? '' : 'hidden' }}">
                                            Hapus Gambar
                                        </button>

                                        @error('image') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                                    </div>
                                </x-modal>
                            @endforeach

                        </table>

                    </div>
                    <div class="dark:text-white/70">
                        {{ $brands->links() }}
                    </div>
                </div>
                
                <x-modal id="modalTambahBrand" title="Tambah Brand Baru" action="{{ route('brands.store') }}">
                    <div class="mb-4 mt-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Nama Brand</label>
                        <input type="text" name="name"
                                class="w-full px-3 py-2 border rounded-lg dark:bg-black dark:border-purple-500/30 dark:text-white dark:placeholder-white/50"
                                value="{{ old('name') }}" required placeholder="Masukkan Nama Brand">
                
                        @error('name') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Asal Brand</label>
                        <input type="text" name="brand_origin"
                                class="w-full px-3 py-2 border rounded-lg dark:bg-black dark:border-purple-500/30 dark:text-white dark:placeholder-white/50"
                                value="{{ old('brand_origin') }}" required placeholder="Masukkan Asal Brand">
                        @error('brand_origin') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Warna Brand</label>

                        <div class="grid grid-cols-2 gap-y-3">
                            @foreach ($colors as $color)
                                <label class="flex items-center gap-4 cursor-pointer">

                                    <input type="radio"
                                        name="id_color"
                                        value="{{ $color->id_color }}"
                                        class="appearance-none w-4 h-4 border border-gray-400 dark:border-white/30 rounded-full 
                                            checked:border-transparent checked:bg-[{{ $color->hex }}] 
                                            focus:outline-none focus:ring-2 focus:ring-offset-1 dark:focus:ring-purple-500
                                            transition-all duration-200 cursor-pointer"
                                        style="box-shadow: inset 0 0 0 3px white;"
                                        {{ old('id_color') == $color->id_color ? 'checked' : '' }}>

                                    <span class="text-gray-700 dark:text-white/70 text-sm">{{ $color->nama }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('id_color')
                            <p class="text-red-500 dark:text-purple-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Gambar Brand</label>

                        <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 dark:border-purple-500/30 rounded-lg p-6 cursor-pointer hover:border-primary dark:hover:border-purple-500 transition"
                                onclick="document.getElementById('image').click()" id="uploadArea">
                                <div id="previewArea" class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-purple-400 mb-3"></i>
                                    <p class="text-sm text-gray-500 dark:text-white/60">Klik untuk mengunggah gambar</p>
                                    <p class="text-xs text-gray-400 dark:text-white/40 mt-1">Format: JPG, PNG, GIF (Maks. 5MB)</p>
                            </div>
                        </div>

                        <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">

                        <button type="button" id="deleteImageBtn"
                                    onclick="clearImage()"
                                    class="mt-3 px-3 py-1 bg-red-500 dark:bg-purple-500 text-white rounded hidden opacity-0">
                                Hapus Gambar
                        </button>

                        @error('image') <p class="text-red-500 dark:text-purple-400 text-xs">{{ $message }}</p> @enderror
                    </div>
                </x-modal>

                <x-modal-ajax id="global-modal" title="Data Brand" />
@endsection