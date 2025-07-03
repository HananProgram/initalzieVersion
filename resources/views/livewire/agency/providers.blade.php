<div class="space-y-6">
    <!-- العنوان والرسائل -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-emerald-700 border-b-2 border-emerald-200 pb-2">إدارة المزودين</h2>
        
        @if(session('message'))
            <div class="bg-emerald-100 text-emerald-700 rounded-md px-4 py-2 text-center shadow">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <!-- نموذج الإضافة المدمج -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-emerald-700">قائمة المزودين</h2>
            
            <button wire:click="showAddModal"
                    class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                        text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
                + إضافة مزود جديد
            </button>
        </div>

        <!-- جدول العرض -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-2 py-1">#</th>
                        <th class="px-2 py-1">اسم المزود</th>
                        <th class="px-2 py-1">النوع</th>
                        <th class="px-2 py-1">معلومات التواصل</th>
                        <th class="px-2 py-1">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($providers as $provider)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-1 whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-2 py-1 font-medium">{{ $provider->name }}</td>
                            <td class="px-2 py-1">{{ $provider->type ?? '-' }}</td>
                            <td class="px-2 py-1 text-xs whitespace-pre-line">{{ $provider->contact_info ?? '-' }}</td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                <button wire:click="showEditModal({{ $provider->id }})"
                                        class="text-emerald-600 hover:text-emerald-800 font-medium text-xs mx-1">
                                    تعديل
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">لا توجد مزودين مسجلين</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 bg-black/10 flex items-center justify-center backdrop-blur-sm">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 p-6 relative transform transition-all duration-300">
                <button wire:click="$set('showModal', false)"
                        class="absolute top-3 left-3 text-gray-400 hover:text-red-500 text-xl font-bold">
                    &times;
                </button>

                <h3 class="text-xl font-bold text-emerald-700 mb-4 text-center">
                    {{ $editMode ? 'تعديل المزود' : 'إضافة مزود جديد' }}
                </h3>

                <form wire:submit.prevent="saveProvider" class="space-y-4 text-sm">
                    @php
                        $fieldClass = 'w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer';
                        $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600';
                        $containerClass = 'relative mt-1';
                    @endphp

                    <!-- اسم المزود -->
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="name" class="{{ $fieldClass }}" placeholder="اسم المزود" />
                        <label class="{{ $labelClass }}">اسم المزود</label>
                        @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- نوع المزود -->
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="type" class="{{ $fieldClass }}" placeholder="نوع المزود (اختياري)" />
                        <label class="{{ $labelClass }}">نوع المزود</label>
                        @error('type') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- معلومات التواصل -->
                    <div class="{{ $containerClass }}">
                        <textarea wire:model.defer="contact_info" rows="2" class="{{ $fieldClass }}" placeholder="معلومات التواصل"></textarea>
                        <label class="{{ $labelClass }}">معلومات التواصل</label>
                        @error('contact_info') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" wire:click="$set('showModal', false)"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded-xl shadow transition duration-300 text-sm">
                            إلغاء
                        </button>
                        <button type="submit"
                                class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                                    text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
                            {{ $editMode ? 'تحديث' : 'إضافة' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <style>
        .peer:placeholder-shown + label {
            top: 0.75rem;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .peer:not(:placeholder-shown) + label,
        .peer:focus + label {
            top: -0.5rem;
            font-size: 0.75rem;
            color: #059669;
        }
        
        select:required:invalid {
            color: #6b7280;
        }
        
        select option {
            color: #111827;
        }
    </style>
</div>