@props(['answer','item'])
<div {{ $attributes->merge(['class' => 'flex space-x-2  items-baseline']) }}>
   <div class="border border-gray-400 text-gray-500 flex justify-center items-center  rounded-full size-6">{{ $item }}</div>
   <div> {{ $answer }}</div>
</div>