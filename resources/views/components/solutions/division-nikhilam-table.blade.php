@props(['table','columnLine','HorizonLine'])

<table>
    @foreach ($table as $row) 
        <tr>
            @foreach ($row as $col)
                <td @class([
                    'border  w-6 text-right border-gray-200 ',
                    'border-r-2 border-r-black' =>
                        $loop->iteration === $columnLine,
                    'border-t-2 border-t-black' =>
                        $loop->parent->last && $loop->iteration >= $horizonLine,
                ])>
                    {!! $col === '' ? '&nbsp;' : $col !!}
                </td> 
                
            @endforeach
        </tr>
    @endforeach
</table>

