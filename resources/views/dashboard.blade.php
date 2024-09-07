<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แดชบอร์ด
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-4">
            <x-dashboard-card class="bg-white" heading="เวทคณิต" title="แบบเติมคำตอบ" subtitle="พร้อมเฉลย" url="/vedics" />
            <x-dashboard-card class="bg-white" heading="เวทคณิต" title="แบบวิธีทำ" subtitle="พร้อมเฉลย" url="/vedics/solution" />
            <x-dashboard-card class="bg-white" heading="รูปเล่ม" title="เลือกเล่ม" subtitle="" url="/books" />
            
        </div>
    </div>
</x-app-layout>
