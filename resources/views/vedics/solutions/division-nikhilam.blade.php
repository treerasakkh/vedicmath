<x-book>
    @unless ($levelTitle === 'ม.1-3')
        {{-- ข้อสอบ --}}
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$quizzes" :show-solution="false" />
        </x-page>
        {{-- เฉลย --}}
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$quizzes" :show-solution="true" />
        </x-page>
    @else
        @php
            [$set1, $set2] = array_chunk($quizzes, 2);
        @endphp
        <!-- ข้อสอบชุดที่ 1 -->
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$set1" :show-solution="false" />
        </x-page>
        <!-- ข้อสอบชุดที่ 2 -->
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$set2" :show-solution="false" :begin-item="2"  />
        </x-page>
        <!-- เฉลยชุดที่ 1 -->
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$set1" :show-solution="true" />
        </x-page>
        <!-- เฉลยชุดที่ 2 -->
        <x-page>
            <x-solutions.division-quiz-section :level-title="$levelTitle" :difficulty-title="$difficultyTitle" :quizzes="$set2" :show-solution="true" :begin-item="2" />
        </x-page>
    @endunless
</x-book>
