@props([
    'id' => 'loadingSkeleton',
    'rows' => 5,
])

<tbody id="{{ $id }}" {{ $attributes->merge(['class' => 'hidden']) }}>
    @for ($i = 0; $i < $rows; $i++)
        {{ $slot }}
    @endfor
</tbody>

<style>
.skeleton {
    position: relative;
    overflow: hidden;
    background-color: rgba(200,200,200,0.2);
}

.skeleton::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,0.4),
        transparent
    );
    transform: translateX(-100%);
    animation: shimmer 1.4s infinite;
}

@keyframes shimmer {
    100% {
        transform: translateX(100%);
    }
}
</style>