@props(['table'])
<table {{ $attributes }}>
    @foreach ($table->tableFormat as $row)
        <tr>
            @foreach ($row as $col)
                <td @class([
                    'w-6 text-right border',
                    'border-t-2 border-t-black' => $loop->parent->last,
                    'border-r-2 border-r-black' =>
                        $loop->iteration === $table->startPosition + $table->numLeftDividend,
                ])>
                    {!! $col !!}
                </td>
            @endforeach
        </tr>
    @endforeach
</table>