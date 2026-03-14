@props([
    'id' => 'loadingSkeleton',
    'cols' => 4,
    'rows' => 8,
])

<tbody id="{{ $id }}" {{ $attributes->merge(['class' => 'hidden']) }} class="hidden animate-pulse">
    @for ($i = 0; $i < $rows; $i++)
        <tr class="bg-gray-100 dark:bg-purple-500/5 border-b dark:border-purple-500/10">
            @for ($j = 0; $j < $cols; $j++)
                <td class="px-6 py-4">
                    <div class="h-4 bg-gray-300 dark:bg-purple-500/30 rounded"></div>
                </td>
            @endfor
        </tr>
    @endfor
</tbody>