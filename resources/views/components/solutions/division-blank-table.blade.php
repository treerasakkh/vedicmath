@props(['numRows','numcolumns'])
<table {{ $attributes }}>

    @for ($row = 0; $row < $numRows; $row++)
        <tr>
            @for ($col = 0; $col < $numColumns; $col++)
                <td class="border border-gray-400 w-8">&nbsp;</td>
            @endfor
        </tr>
    @endfor
</table>