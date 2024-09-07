<x-book>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกลบโดยใช้วิธีนิขิลัม ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes as $quiz )
            <x-solutions.subtraction-nikhilam :num1="$quiz->num1" :num2="$quiz->num2" :show-solution="false" :item="$loop->iteration" />
                
            @endforeach
        </div>
    </x-page>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกลบโดยใช้วิธีนิขิลัม ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes as $quiz )
            <x-solutions.subtraction-nikhilam :num1="$quiz->num1" :num2="$quiz->num2" :show-solution="true" :item="$loop->iteration" />
                
            @endforeach
        </div>
    </x-page>
</x-book>
