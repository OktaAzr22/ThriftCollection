

@if ($items->isEmpty())
    <div class="w-full p-4 text-center text-gray-500 italic border rounded-lg bg-gray-50">
        Tidak ada item untuk brand {{ $brand->name }}.
    </div>
@else
<h3 class="text-lg font-bold mb-4 text-center">
    Item dari Brand: {{ $brand->name }}
</h3>
    @foreach ($items as $item)
    
        <div class="mb-4 p-4 border bg-white rounded-lg shadow-sm flex gap-4 items-start">

            @if ($item->gambar)
                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                </div>
            @else
                <div class="flex-shrink-0 h-12 w-12 rounded-lg border border-gray-300 bg-gray-100 flex items-center justify-center">
                    <span class="text-xs italic text-gray-400">None</span>
                </div>
            @endif

            <div>
                <p class="font-semibold">{{ $item->nama }}</p>
                <p class="text-sm text-gray-500">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>
            </div>

        </div>
    @endforeach
@endif
