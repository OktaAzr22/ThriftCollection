@props([
    'id' => 'loadingSkeleton',
    'cols' => 4,
    'rows' => 8,
])

<tbody id="{{ $id }}" {{ $attributes->merge(['class' => 'hidden']) }} class="hidden animate-pulse">
    @for ($i = 0; $i < $rows; $i++)
        <tr class="bg-gray-100 border-b">
            @for ($j = 0; $j < $cols; $j++)
                <td class="px-6 py-4">
                    <div class="h-4 bg-gray-300 rounded"></div>
                </td>
            @endfor
        </tr>
    @endfor
</tbody>