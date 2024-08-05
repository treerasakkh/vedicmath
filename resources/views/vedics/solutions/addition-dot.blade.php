<x-book>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 0; $i < 8; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 0; $i < 10; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 8; $i < 16; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 10; $i < 18; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @endif
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')

                @for ($i = 16; $i < 24; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 18; $i < 26; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">ข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 24; $i < 30; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 26; $i < 30; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="false" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>
{{-- Answer Section --}}
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 0; $i < 8; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 0; $i < 10; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 8; $i < 16; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 10; $i < 18; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @endif
        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')

                @for ($i = 16; $i < 24; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 18; $i < 26; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>
    <x-page>
        <div class="text-center mt-8 mb-4 font-semibold">เฉลยข้อสอบแบบวิธีทำระดับชั้น {{ $levelTitle }} เรื่อง
            การบวกแบบทดจุด ระดับ{{ $difficultyTitle }}</div>
        <div class="grid grid-cols-2 gap-8">
            @if ($levelTitle === 'ม.1-3')
                @for ($i = 24; $i < 30; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @else
                @for ($i = 26; $i < 30; $i++)
                    <x-solutions.addition_dot :numbers="$quizzes[$i]->numbers" :show-solution="true" :item="$i + 1" />
                @endfor
            @endif

        </div>
    </x-page>

</x-book>
