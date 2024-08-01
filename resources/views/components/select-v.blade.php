@props(['label','name', 'values'])

<div class="space-y-1 my-2">
    <label for="{{ $name }}" class="block">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="w-full block">
        @foreach ($values as $value)
            <option value="{{ $value->code }}">{{ $value->explain }}</option>
        @endforeach
    </select>
</div>