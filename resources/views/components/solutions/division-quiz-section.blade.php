@props(['levelTitle', 'difficultyTitle', 'quizzes','beginItem'=>0])
<div>
    <div class="text-center  mb-2 font-semibold">
        @if ($showSolution)
            <span>เฉลย</span>
        @endif
        ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง การหารโดยใช้วิธีนิขิลัม ระดับ{{ $difficultyTitle }}
    </div>
    <div class="grid grid-cols-2 gap-2">
        @foreach ($quizzes as $quiz)
            <x-solutions.division-nikhilam :dividend="$quiz->num1" :divisor="$quiz->num2" :item="$loop->iteration+$beginItem" :show-solution="$showSolution" :is-m13="$levelTitle=='ม.1-3'"/>
        @endforeach
    </div>
</div>
