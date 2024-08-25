@props(['digits' => []])
@foreach ($digits as $digit)
    <td>
        {{ $digit }}
    </td>
@endforeach
