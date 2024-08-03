<x-book title="การหาร" :level-title="$levelTitle" :difficulty-title="$difficultyTitle">
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การหาร
            ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @for ($i = 0; $i < 10; $i++)
                <x-answers.division :num1="$quizzes[$i]->num1" :num2="$quizzes[$i]->num2" :item="$i + 1" />
            @endfor
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การหาร
            ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @for ($i = 10; $i < 20; $i++)
                <x-answers.division :num1="$quizzes[$i]->num1" :num2="$quizzes[$i]->num2" :item="$i + 1" />
            @endfor
        </div>
    </x-page>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง
            การหาร ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-6">
            @for ($i = 0; $i < 20; $i++)
                <x-answers.answer :answer="$quizzes[$i]->answer->product.($quizzes[$i]->answer->remainder===0?'':' เศษ '.number_format($quizzes[$i]->answer->remainder))" :item="1 + $i" @class(['ml-20' => $i % 2 === 0]) />
            @endfor
        </div>
    </x-page>
</x-book>
