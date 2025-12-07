@extends('layouts.app')

@section('content')

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded",()=>openModal('modalTambahBrand'));
</script>
@endif

<div class="bg-white rounded-lg shadow p-6 ">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
    <h2 class="text-lg font-bold text-gray-900">Daftar Brand</h2>

    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">

        <form method="GET" action="{{ route('brands.index') }}" 
          class="relative flex justify-end w-full md:w-auto">

        <input 
            class="px-10 py-2 text-sm border border-gray-300 rounded-lg bg-white 
           focus:outline-none focus:ring-0
           focus:border-primary
           transition-all duration-300 ease-in-out
           w-4/5 md:w-48 origin-right focus:w-full md:focus:w-64"
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

        <!-- Icon Search -->
        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

        <!-- Tombol Clear Search -->
        @if(request('search'))
        <button 
            type="button"
            data-target-input="#searchInput"
            data-base-url="{{ route('brands.index') }}"
            onclick="clearSearch(this)"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer">
            <i class="fas fa-times"></i>
        </button>
        @endif
    </form>

        
        <x-button onclick="openModal('modalTambahBrand')">
            Tambah Brand
        </x-button>
    </div>
</div>

    
    <div class="overflow-x-auto rounded-lg">
        @if(request('search'))
            <p class="text-sm text-gray-600 mb-3">
                Menampilkan hasil untuk: 
                <span class="font-semibold">"{{ request('search') }}"</span>
            </p>
        @endif
        <div class="max-h-86 overflow-y-auto no-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800 font-semibold text-gray-600 dark:text-gray-300 uppercase sticky top-0 z-20">
                <tr>
                    <th class="px-6 py-3 text-left">Gambar</th>
                    <th class="px-6 py-3 text-left">Nama Brand</th>
                    <th class="px-6 py-3 text-left">Asal Brand</th>
                    <th class="px-6 py-3 text-left">Item Brand</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <x-skeleton-table id="brandSkeleton" :cols="5" :rows="5" class="mt-6 w-full" />

            <tbody id="tableBody"  class="bg-white divide-y divide-gray-200">
                @if($brands->count() > 0)
                    @foreach($brands as $brand)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4">
                                @if($brand->image)
                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                        class="h-14 w-14 rounded-md object-cover shadow-sm">
                                @else
                                    <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $brand->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $brand->brand_origin }}
                            </td>

                            <td class="px-6 py-4 text-gray-700 font-semibold">
                                {{ $brand->items_count }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-3">        
                                    <button onclick="bukaModal('global-modal', '/brand/{{ $brand->id }}/items')"  class="p-2 hover:bg-blue-100 text-blue-600 rounded-md" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="p-2 hover:bg-red-100 text-red-600 rounded-md"
                                            onclick="openDeleteModal(
                                                '{{ route('brands.destroy', $brand->id) }}', 
                                                'BRAND', 
                                                '{{ $brand->name }}'
                                            )">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button onclick="openModal('modalEditBrand-{{ $brand->id }}')"
                                            class="p-2 hover:bg-yellow-100 text-yellow-600 rounded-md" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="py-4 text-center text-red-500 font-semibold">
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Brand</label>
                        <input type="text" name="name"
                            class="w-full px-3 py-2 border rounded-lg"
                            value="{{ old('name', $brand->name) }}" required placeholder="Masukkan Nama Brand">

                        @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Asal Brand</label>
                        <input type="text" name="brand_origin"
                            class="w-full px-3 py-2 border rounded-lg"
                            value="{{ old('brand_origin', $brand->brand_origin) }}"
                            placeholder="Masukkan Asal Brand">

                        @error('brand_origin') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Warna Brand</label>

                        <div class="grid grid-cols-2 gap-y-3">
                            @foreach ($colors as $color)
                                <label class="flex items-center gap-2 cursor-pointer">

                                    <input type="radio"
                                        name="id_color"
                                        value="{{ $color->id_color }}"
                                        class="appearance-none w-4 h-4 border border-gray-400 rounded-full 
                                            checked:border-transparent 
                                            checked:bg-[{{ $color->hex }}]
                                            focus:outline-none focus:ring-2 focus:ring-offset-1
                                            transition-all duration-200"
                                        style="box-shadow: inset 0 0 0 3px white;"
                                        {{ old('id_color', $brand->id_color) == $color->id_color ? 'checked' : '' }}>

                                    <span class="text-gray-700 text-sm">{{ $color->nama }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('id_color')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Brand</label>

                        <div
                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300
                                rounded-lg p-6 cursor-pointer hover:border-primary transition"
                            onclick="document.getElementById('imageEdit-{{ $brand->id }}').click()"
                            id="uploadAreaEdit-{{ $brand->id }}"
                        >
                            <div id="previewAreaEdit-{{ $brand->id }}" class="text-center">
                                @if ($brand->image)
                                    <img src="{{ asset('storage/' . $brand->image) }}"
                                        class="h-32 rounded-lg mx-auto object-cover mb-3">
                                @else
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                    <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
                                    <p class="text-xs text-gray-400 mt-1">Format JPG/PNG max 2MB</p>
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
                                class="mt-3 px-3 py-1 bg-red-500 text-white rounded {{ $brand->image ? '' : 'hidden' }}">
                            Hapus Gambar
                        </button>

                        @error('image') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>
                </x-modal>
            @endforeach
        </table>
        </div>
        
    </div>
    <div class="mt-4">
        {{ $brands->links() }}
    </div>
</div>

  <x-modal 
      id="modalTambahBrand"
      title="Tambah Brand Baru"
      action="{{ route('brands.store') }}">
      <div class="mb-4 mt-5">
          <label class="block text-sm font-medium text-gray-700 mb-2">Nama Brand</label>
          <input type="text" name="name"
                class="w-full px-3 py-2 border rounded-lg"
                value="{{ old('name') }}" required placeholder="Masukkan Nama Brand">
                
          @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Asal Brand</label>
          <input type="text" name="brand_origin"
                class="w-full px-3 py-2 border rounded-lg"
                value="{{ old('brand_origin') }}" required placeholder="Masukkan Asal Brand">
          @error('brand_origin') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Warna Brand</label>

    <div class="grid grid-cols-2 gap-y-3">
        @foreach ($colors as $color)
            <label class="flex items-center gap-4 cursor-pointer">

                <input type="radio"
                    name="id_color"
                    value="{{ $color->id_color }}"
                    class="appearance-none w-4 h-4 border border-gray-400 rounded-full 
                           checked:border-transparent checked:bg-[{{ $color->hex }}] 
                           focus:outline-none focus:ring-2 focus:ring-offset-1 
                           transition-all duration-200 cursor-pointer"
                    style="box-shadow: inset 0 0 0 3px white;"
                    {{ old('id_color') == $color->id_color ? 'checked' : '' }}>

                <span class="text-gray-700 text-sm">{{ $color->nama }}</span>
            </label>
        @endforeach
    </div>

    @error('id_color')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>





      <!-- Upload gambar -->
      <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Brand</label>

          <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 cursor-pointer hover:border-primary transition"
                onclick="document.getElementById('image').click()" id="uploadArea">
                <div id="previewArea" class="text-center">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                    <p class="text-sm text-gray-500">Klik untuk mengunggah gambar</p>
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, GIF (Maks. 5MB)</p>
              </div>
          </div>

          <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(event)">

          <button type="button" id="deleteImageBtn"
                    onclick="clearImage()"
                    class="mt-3 px-3 py-1 bg-red-500 text-white rounded hidden opacity-0">
                Hapus Gambar
          </button>

          @error('image') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
      </div>
  </x-modal>



  <x-modal-ajax id="global-modal" title="Data Brand" />


@endsection


