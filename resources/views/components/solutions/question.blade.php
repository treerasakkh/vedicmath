@props(['question','showSolution','expand'])

<div {{ $attributes->merge(['class'=>"absolute left-14 top-4"]) }} >
    <span>{!! $question !!} </span>
    <x-solutions.question-expand :$showSolution :$expand />
</div>
