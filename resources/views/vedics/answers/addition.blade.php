<x-book>

    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การบวก ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-3 gap-4">
            @for ($i = 0; $i < 10; $i++)
                <x-answers.addition :numbers="$quizzes[$i]->numbers" :item="1 + $i" />
            @endfor
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การบวก ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-3 gap-4">
            @for ($i = 10; $i < 20; $i++)
                <x-answers.addition :numbers="$quizzes[$i]->numbers" :item="1 + $i" />
            @endfor
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การบวก ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-3 gap-4">
            @for ($i = 20; $i < 30; $i++)
                <x-answers.addition :numbers="$quizzes[$i]->numbers" :item="1 + $i" />
            @endfor
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบเติมคำตอบระดับชั้น {{ $levelTitle }} เรื่อง การบวก ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-6">
            @for ($i = 0; $i < 30; $i++)
                <x-answers.answer :answer="$quizzes[$i]->answer" :item="1 + $i" 
                    @class(["ml-20"=>$i%2===0]) />
            @endfor
        </div>
    </x-page>
</x-book>
: