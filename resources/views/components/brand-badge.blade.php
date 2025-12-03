@php
    $color = $brand->color->hex ?? null;
    $bg = $color ? $color . '44' : '#E5E7EB'; // opacity 26%
    $text = $color ? $textColor($color) : '#374151';
    $border = $color ?? '#D1D5DB';
@endphp

<span class="inline-flex w-fit items-center px-3 py-1.5 text-xs rounded-md font-medium"
      style="
        background-color: {{ $bg }};
        color: {{ $text }};
        border: 1px solid {{ $border }};
      ">
    {{ $brand->name }}
</span>
