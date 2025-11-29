@extends('layouts.app')

@section('content')

  <div class="bg-white rounded-lg shadow p-6 mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
      <h2 class="text-lg font-bold text-gray-900">Daftar Brand</h2>
        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
          <div class="relative w-full md:w-64">
            <input type="text" placeholder="Cari brand..."
              class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </div>

          <button onclick="openModal('modalTambahBrand')"
                  class="px-3 py-2 bg-primary text-white rounded-lg">
              + Tambah Brand
          </button>
        </div>
    </div>

                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 font-semibold text-gray-600 uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-left">Gambar</th>
                                    <th class="px-6 py-3 text-left">Nama Brand</th>
                                    <th class="px-6 py-3 text-left">Asal Brand</th>
                                    <th class="px-6 py-3 text-left">Item Brand</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
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

                                    <!-- ASAL -->
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $brand->brand_origin }}
                                    </td>

                                    <!-- TOTAL ITEM -->
                                    <td class="px-6 py-4 text-gray-700 font-semibold">
                                        {{ $brand->items_count }}
                                    </td>

                                    <!-- AKSI -->
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center space-x-3">
                                          <a href="{{ route('brands.items', $brand->id) }}">
                                            <button class="p-2 hover:bg-blue-100 text-blue-600 rounded-md" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                          </a>

                                          <button 
                                                onclick="openDeleteModal(
                                                    '{{ route('brands.destroy', $brand->id) }}', 
                                                    'BRAND', 
                                                    '{{ $brand->name }}'
                                                )"
                                                class="p-2 hover:bg-red-100 text-red-600 rounded-md">
                                                <i class="fas fa-trash"></i>
                                            </button>


                                          

                                            

                                            <button onclick="openModal('modalEditBrand-{{ $brand->id }}')"
        class="p-2 hover:bg-yellow-100 text-yellow-600 rounded-md" title="Edit">
    <i class="fas fa-edit"></i>
</button>

                                            

                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal Edit Brand -->
    
                                  @endforeach
                            </tbody>
                            @foreach ($brands as $brand)
                            <x-modal 
        id="modalEditBrand-{{ $brand->id }}"
        title="Edit Brand"
        action="{{ route('brands.update', $brand->id) }}"
        method="PUT"
    >
    
        <!-- NAME -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Brand</label>
            <input type="text" name="name"
                class="w-full px-3 py-2 border rounded-lg"
                value="{{ old('name', $brand->name) }}" required placeholder="Masukkan Nama Brand">

            @error('name') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
        </div>

        

        <!-- ORIGIN -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Asal Brand</label>
            <input type="text" name="brand_origin"
                class="w-full px-3 py-2 border rounded-lg"
                value="{{ old('brand_origin', $brand->brand_origin) }}"
                placeholder="Masukkan Asal Brand">

            @error('brand_origin') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
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
                    <div class="mt-4">
        {{ $brands->links() }}
    </div>
                </div>
{{--  --}}



   

   
  <x-modal 
      id="modalTambahBrand"
      title="Tambah Brand Baru"
      action="{{ route('brands.store') }}">
      <div class="mb-4">
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

      <!-- Upload gambar -->
      <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Brand</label>

          <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300
                      rounded-lg p-6 cursor-pointer hover:border-primary transition"
              onclick="document.getElementById('image').click()"
              id="uploadArea">

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

{{-- Auto-open modal jika error --}}
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded",()=>openModal('modalTambahBrand'));
</script>
@endif

   
@endsection