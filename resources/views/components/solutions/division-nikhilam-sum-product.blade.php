@props(['arrProducts','product','isMoreThreeTables'])
<div {{ $attributes }}>
    <span>ผลหารรวมกันได้</span>
    @foreach ($arrProducts as $arrProduct)
        <span class="tracking-tighter">
            @foreach ($arrProduct as $number)
                @php
                    $strNumber = (string) $number;
                    $x = substr($strNumber, 0, -1);
                    $y = substr($strNumber, -1);
                @endphp
                <span>{!! '<sub>' . $x . '</sub>' . $y !!}</span>
            @endforeach
        </span>
        @if (!$loop->last)
            <span>+</span>
        @endif
    @endforeach
    @if ($isMoreThreeTables)
        <span class="text-red-500">.....</span>
    @endif
    <span> = {{ number_format($product) }}</span>
</div>