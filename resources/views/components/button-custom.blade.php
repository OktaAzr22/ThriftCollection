@props([
    'label' => 'Simpan',
    'loading' => 'Menyimpan...'
])

<button 
    type="submit"
    {{ $attributes->merge([
        'class' => 'button-custom px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold inline-flex items-center gap-2 cursor-pointer'
    ]) }}
    data-label="{{ $label }}"
    data-loading="{{ $loading }}"
>
    <!-- Spinner -->
    <span class="spinner hidden">
        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" 
                stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </span>

    <span class="button-text">{{ $label }}</span>
</button>
