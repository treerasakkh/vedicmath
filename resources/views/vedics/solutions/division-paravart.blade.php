<x-book>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การหารโดยใช้วิธีพาราวารท ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes[0] as $quiz)
                <x-solutions.division-paravart :dividend="$quiz->dividend" :divisor="$quiz->divisor" :item="$loop->iteration"
                    :showSolution="false" />
            @endforeach

        </div>
    </x-page>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การหารโดยใช้วิธีพาราวารท ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes[1] as $quiz)
                <x-solutions.division-paravart :dividend="$quiz->dividend" :divisor="$quiz->divisor" :item="$loop->iteration"
                    :showSolution="false" />
            @endforeach

        </div>
    </x-page>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การหารโดยใช้วิธีพาราวารท ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes[0] as $quiz)
                <x-solutions.division-paravart :dividend="$quiz->dividend" :divisor="$quiz->divisor" :item="$loop->iteration"
                    :showSolution="true" />
            @endforeach

        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การหารโดยใช้วิธีพาราวารท ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @foreach ($quizzes[1] as $quiz)
                <x-solutions.division-paravart :dividend="$quiz->dividend" :divisor="$quiz->divisor" :item="$loop->iteration"
                    :showSolution="true" />
            @endforeach

        </div>
    </x-page>
</x-book>
