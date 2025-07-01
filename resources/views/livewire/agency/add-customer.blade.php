<div class="space-y-6">
    <!-- نموذج الإضافة -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <h2 class="text-2xl font-bold text-emerald-700 mb-6 text-center">إضافة عميل جديد</h2>

        <form wire:submit.prevent="save" class="space-y-6 text-base">
            @php
                $fieldClass = 'w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white text-base';
                $labelClass = 'block mb-2 text-gray-700 font-semibold text-base';
            @endphp

            <div class="grid md:grid-cols-4 gap-6">
                <div>
                    <label class="{{ $labelClass }}">الاسم الكامل</label>
                    <input type="text" wire:model.defer="name" class="{{ $fieldClass }}" />
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="{{ $labelClass }}">البريد الإلكتروني</label>
                    <input type="email" wire:model.defer="email" class="{{ $fieldClass }}" />
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="{{ $labelClass }}">رقم الهاتف</label>
                    <input type="text" wire:model.defer="phone" class="{{ $fieldClass }}" />
                    @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="{{ $labelClass }}">العنوان</label>
                    <input type="text" wire:model.defer="address" class="{{ $fieldClass }}" />
                    @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

   <div class="text-center pt-4 flex flex-col sm:flex-row justify-center gap-4">
    <button type="submit"
        class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-8 py-3 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-lg">
        {{ $editingId ? 'تأكيد التعديل' : 'حفظ العميل' }}
    </button>

    <button type="button" wire:click="resetFields"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-8 py-3 rounded-xl shadow transition duration-300 text-lg">
        تنظيف الحقول
    </button>
</div>


            @if (session()->has('success'))
                <div class="text-center mt-4 text-green-600 font-semibold text-base">
                    {{ session('success') }}
                </div>
            @endif
        </form>
    </div>

    <!-- جدول عرض العملاء -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-right">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-2">الاسم</th>
                        <th class="px-4 py-2">البريد</th>
                        <th class="px-4 py-2">الهاتف</th>
                        <th class="px-4 py-2">العنوان</th>
                        <th class="px-4 py-2">تاريخ الإضافة</th>
                        <th class="px-4 py-2">إجراءات</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $customer->name }}</td>
                            <td class="px-4 py-2">{{ $customer->email ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $customer->phone ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $customer->address ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $customer->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 text-center">
    <button wire:click="edit({{ $customer->id }})"
        class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
        تعديل
    </button>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">لا يوجد عملاء حتى الآن</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="px-4 py-2 border-t border-gray-200">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
