<x-frame class="block">
    <x-item class="absolute top-4 left-4">{{ $item }} </x-item>
    <x-solutions.question :$question :$expand :$showSolution />

    @if ($showSolution === true)
        <div class="mt-8">
            <div class="w-[100%]">
                <x-solutions.mbs-row :left="$row1Left" :middle="$row1Middle" :right="$row1Right" />
                <x-solutions.mbs-row :left="$row2Left" :middle="$row2Middle" :right="$row2Right"
                    class="border-b border-b-gray-400" />

                @if ($type === 'secondary-base')
                    <x-solutions.mbs-row :left="view('components.solutions.mbs-row-x', [
                        'number' => $resultLeftStr,
                        'multiply' => $mulOfBase,
                    ])->render()" :middle="$row3Middle" :right="$row3Right"
                        class=" pt-4 border-b border-b-gray-400" />
                @endif

                <x-solutions.mbs-row :left="$row4Left" :middle="$row4Middle" :right="$row4Right"
                    class="border-b-4 border-b-gray-400 border-double pt-4" />
                <div class="mt-4 ">ดังนั้น {{ $num1 }} &times; {{ $num2 }} = {!! $row4Left . $row4Right !!}
                </div>
                <div class="mt-1"><span class="border-b-4 border-b-gray-400 border-double">ตอบ
                    </span>{{ number_format($product) }}</div>
            </div>
        </div>

        @if ($type === 'different-base')
            <div class="mt-4 text-right">
                <div class="text-[8px] -ml-8">สัดส่วนฐาน</div>
                <div class="mt-1">{{ $num1Ratio }}</div>
                <div>{{ $num2Ratio }}</div>
            </div>
        @endif
    @else
        <div class="mt-8">
            <div class="w-[100%]">
                <x-solutions.mbs-row left="&nbsp;" middle="&nbsp;" right="&nbsp;" class=" border-b border-gray-200" />
                <x-solutions.mbs-row left="&nbsp;" middle="&nbsp;" right="&nbsp;" class=" border-b border-gray-200" />

                <x-solutions.mbs-row left="&nbsp;" middle="&nbsp;" right="&nbsp;"
                    class=" pt-4  border-b border-gray-200" />

                <x-solutions.mbs-row left="&nbsp;" middle="&nbsp;" right="&nbsp;"
                    class="pt-4 border-b border-gray-200" />
                <div class="mt-4 ">ดังนั้น
                </div>
                <div class="mt-1"><span class="border-b-4 border-b-gray-400 border-double">ตอบ
                    </span>&nbsp;</div>
            </div>
        </div>

    @endif
</x-frame>
