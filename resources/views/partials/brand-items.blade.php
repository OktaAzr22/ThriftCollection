@if ($items->isEmpty())
    <div class="w-full p-4 text-center text-gray-500 dark:text-white/60 italic border rounded-lg bg-gray-50 dark:bg-black dark:border-purple-500/20">
        Tidak ada item untuk brand {{ $brand->name }}.
    </div>
@else
<h3 class="text-lg font-bold mb-4 text-center dark:text-white">
    Item dari Brand: <span class="dark:text-purple-400">{{ $brand->name }}</span>
</h3>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @foreach ($items as $item)
        
        <div class="p-4 border bg-white dark:bg-black rounded-lg shadow-sm dark:shadow-purple-500/10 flex gap-4 items-start dark:border-purple-500/20">

            @if ($item->gambar)
                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden border border-gray-200 dark:border-purple-500/30">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}">
                </div>
            @else
                <div class="flex-shrink-0 h-12 w-12 rounded-lg border border-gray-300 dark:border-purple-500/30 bg-gray-100 dark:bg-purple-900/20 flex items-center justify-center">
                    <span class="text-xs italic text-gray-400 dark:text-white/40">None</span>
                </div>
            @endif

            <div>
                <p class="font-semibold dark:text-white">{{ $item->nama }}</p>
                <p class="text-sm text-gray-500 dark:text-white/60">
                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                </p>
            </div>

        </div>

    @endforeach
</div>
@endif