@props(['expand', 'showSolution'])
<span class="text-xs text-red-500">
    @if ($showSolution)
        ({{ $expand }})
    @endif
</span>
