<x-app-layout>

    @if ($type == 'solution')
        <div class="max-w-sm mx-auto flex flex-col px-2 lg:px-0">
            <div class="font-bold text-lg mt-8">เลือกข้อสอบเวทคณิตแบบแสดงวิธีทำ</div>
            <form action="{{ route('vedics.navigate') }}" method="POST">
                @csrf
                <x-select-v label="ระดับชั้น" name="level" :values="$levels" />
                <x-select-v label="วิธี" name="method" :values="$methods" />
                <x-select-v label="ความยากง่าย" name="difficulty" :values="$difficulties" />
                <x-primary-button>submit</x-primary-button>
            </form>
        </div>
    @else
        <div class="max-w-sm mx-auto flex flex-col px-2 lg:px-0">
            <div class="font-bold text-lg mt-8">เลือกข้อสอบเวทคณิตแบบเติมคำตอบ</div>
            <form action="{{ route('vedics.navigate') }}" method="POST">
                @csrf
                <x-select-v label="ระดับชั้น" name="level" :values="$levels" />
                <x-select-v label="การดำเนินการ" name="operation" :values="$operations" />
                <x-select-v label="ความยากง่าย" name="difficulty" :values="$difficulties" />
                <x-primary-button>submit</x-primary-button>
            </form>
        </div>
    @endif

</x-app-layout>
