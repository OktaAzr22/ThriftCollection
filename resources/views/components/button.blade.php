@props([
    'type' => 'button',
])

<button 
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'px-3 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition'
    ]) }}
>
    {{ $slot }}
</button>
