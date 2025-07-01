<div class="max-w-3xl mx-auto mt-12 bg-white/80 backdrop-blur-md p-8 rounded-3xl shadow-2xl border border-emerald-200">
    <h2 class="text-2xl font-extrabold text-emerald-700 mb-8 text-center">إدارة أنواع الخدمات</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-700 bg-green-100 rounded-lg p-3 text-center">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-6 text-right">
        <button wire:click="showAddModal" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-2 rounded-xl shadow-md transition">إضافة نوع خدمة جديد</button>
    </div>

    <table class="w-full text-center border border-emerald-200 rounded-xl overflow-hidden">
        <thead class="bg-emerald-50">
            <tr>
                <th class="py-2 px-4">#</th>
                <th class="py-2 px-4">اسم نوع الخدمة</th>
                <th class="py-2 px-4">إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($serviceTypes as $type)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $type->id }}</td>
                    <td class="py-2 px-4">{{ $type->name }}</td>
                    <td class="py-2 px-4">
                        <button wire:click="showEditModal({{ $type->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">تعديل</button>
                        <button wire:click="deleteServiceType({{ $type->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded ml-2">حذف</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-4 text-gray-500">لا توجد أنواع خدمات بعد.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50" style="background: transparent;">
            <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
                <h3 class="text-xl font-bold mb-4 text-emerald-700">{{ $editMode ? 'تعديل نوع الخدمة' : 'إضافة نوع خدمة' }}</h3>
                <form wire:submit.prevent="saveServiceType" class="space-y-4">
                    <div>
                        <label class="block mb-2 font-bold">اسم نوع الخدمة</label>
                        <input type="text" wire:model="name" class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none" />
                        @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-2 rounded-xl shadow-md transition">{{ $editMode ? 'تحديث' : 'إضافة' }}</button>
                        <button type="button" wire:click="$set('showModal', false)" class="ml-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-6 py-2 rounded-xl">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
