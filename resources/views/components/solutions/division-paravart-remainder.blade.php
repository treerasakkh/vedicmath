@props(['remainder', 'divisor', 'isThirdTable'])

<div class="mb-2 mt-1">

    @if ($remainder < 0)
        <span>เศษ {!! $remainder !!} < 0 หารต่อ</span>
            @elseif ($remainder >= $divisor)
                <span>เศษ {!! $remainder !!} {{ $remainder ===$divisor?'=':'>' }} {!! $divisor !!} หารต่อ</span>
            {{-- @elseif($remainder === 0)
                <span>&nbsp;</span> --}}
            @else
                <span>เศษ {!! $remainder !!} </span>
    @endif

    @if ($isThirdTable)
        <x-solutions.division-more :is-more="true" />
    @endif

</div>
