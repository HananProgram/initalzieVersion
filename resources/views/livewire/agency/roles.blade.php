<div class="space-y-6">
    <!-- العنوان الرئيسي -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-emerald-700 border-b-2 border-emerald-200 pb-2">إدارة الأدوار</h2>
        <button wire:click="$set('showAddForm', true)" 
                class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                       text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
            + إضافة دور جديد
        </button>
    </div>

    <!-- حقل البحث -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="relative mt-1">
            <input wire:model.live="search" 
                   type="text" 
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs"
                   placeholder=" ">
            <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500">
                بحث في الأدوار
            </label>
        </div>
    </div>

    <!-- نافذة إضافة/تعديل الدور -->
    @if($showAddForm)
    <div class="fixed inset-0 z-50 bg-black/10 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl mx-4 p-6 relative transform transition-all duration-300">
            <button wire:click="$set('showAddForm', false)"
                    class="absolute top-3 left-3 text-gray-400 hover:text-red-500 text-xl font-bold">
                &times;
            </button>

            <h3 class="text-xl font-bold text-emerald-700 mb-4 text-center">
                {{ $editingRole ? 'تعديل الدور' : 'إضافة دور جديد' }}
            </h3>

            <form wire:submit.prevent="{{ $editingRole ? 'updateRole' : 'addRole' }}" class="space-y-4 text-sm">
                @php
                    $fieldClass = 'w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer';
                    $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600';
                    $containerClass = 'relative mt-1';
                @endphp

                <!-- اسم الدور -->
                <div class="{{ $containerClass }}">
                    <input wire:model="name" type="text" class="{{ $fieldClass }}" placeholder="اسم الدور" />
                    <label class="{{ $labelClass }}">اسم الدور</label>
                    @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- اسم العرض -->
                <div class="{{ $containerClass }}">
                    <input wire:model="display_name" type="text" class="{{ $fieldClass }}" placeholder="اسم العرض" />
                    <label class="{{ $labelClass }}">اسم العرض</label>
                    @error('display_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الوصف -->
                <div class="{{ $containerClass }}">
                    <textarea wire:model="description" rows="3" class="{{ $fieldClass }}" placeholder="الوصف"></textarea>
                    <label class="{{ $labelClass }}">الوصف</label>
                    @error('description') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الصلاحيات -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-3">الصلاحيات</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($availablePermissions as $permission => $label)
                            <div class="flex items-center">
                                <input wire:model="permissions" 
                                       type="checkbox" 
                                       value="{{ $permission }}" 
                                       id="perm_{{ $permission }}"
                                       class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                                <label for="perm_{{ $permission }}" class="mr-2 text-xs text-gray-700">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الأزرار -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" wire:click="$set('showAddForm', false)"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded-xl shadow transition duration-300 text-sm">
                        إلغاء
                    </button>
                    <button type="submit"
                            class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                                  text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
                        {{ $editingRole ? 'تحديث' : 'إضافة' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- جدول الأدوار -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-2 py-1">اسم الدور</th>
                        <th class="px-2 py-1">الوصف</th>
                        <th class="px-2 py-1">الصلاحيات</th>
                        <th class="px-2 py-1">عدد المستخدمين</th>
                        <th class="px-2 py-1">تاريخ الإنشاء</th>
                        <th class="px-2 py-1">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($roles as $role)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-1">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                        <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-medium">{{ $role->display_name }}</div>
                                        <div class="text-2xs text-gray-500">{{ $role->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-1 max-w-xs truncate">
                                {{ $role->description ?: 'لا يوجد وصف' }}
                            </td>
                            <td class="px-2 py-1">
                                <div class="flex flex-wrap gap-1">
                                    @php
                                        $permissions = $role->permissions ?? [];
                                        if (is_string($permissions)) {
                                            $permissions = json_decode($permissions, true) ?? [];
                                        } elseif (!is_array($permissions)) {
                                            $permissions = [];
                                        }
                                    @endphp
                                    @foreach(array_slice($permissions, 0, 3) as $permission)
                                        <span class="inline-flex px-1.5 py-0.5 text-2xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $availablePermissions[$permission] ?? $permission }}
                                        </span>
                                    @endforeach
                                    @if(count($permissions) > 3)
                                        <span class="inline-flex px-1.5 py-0.5 text-2xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            +{{ count($permissions) - 3 }} أكثر
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                {{ $role->users_count }}
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                {{ $role->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                <div class="flex gap-2">
                                    <button wire:click="editRole({{ $role->id }})"
                                            class="text-emerald-600 hover:text-emerald-800 font-medium text-xs">
                                        تعديل
                                    </button>
                                    <button wire:click="deleteRole({{ $role->id }})"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا الدور؟')"
                                            class="text-red-600 hover:text-red-800 font-medium text-xs">
                                        حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-400">
                                لا يوجد أدوار مسجلة حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($roles->hasPages())
            <div class="px-4 py-2 border-t border-gray-200">
                {{ $roles->links() }}
            </div>
        @endif
    </div>

    <!-- رسالة النجاح -->
    @if(session()->has('message'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 2000)"
             x-show="show"
             x-transition
             class="fixed bottom-4 right-4 bg-emerald-500 text-white px-4 py-2 rounded-md shadow text-sm">
            {{ session('message') }}
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
    </style>
</div>