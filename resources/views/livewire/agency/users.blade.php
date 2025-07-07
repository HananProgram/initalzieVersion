<div class="space-y-6">
    <!-- العنوان الرئيسي -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold" style="color: rgb(var(--primary-700)); border-bottom: 2px solid rgba(var(--primary-200), 0.5); padding-bottom: 0.5rem;">
            إدارة المستخدمين
        </h2>
        <button wire:click="$set('showAddForm', true)" 
                class="text-white font-bold px-4 py-2 rounded-xl shadow-md transition duration-300 text-sm"
                style="background: linear-gradient(to right, rgb(var(--primary-500)) 0%, rgb(var(--primary-600)) 100%);">
            + إضافة مستخدم جديد
        </button>

    </div>

    <!-- حقل البحث -->
    <div class="bg-white rounded-xl shadow-md p-4">
        <div class="relative mt-1">
            <input wire:model.live="search" 
                   type="text" 
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[rgb(var(--primary-500))] focus:border-[rgb(var(--primary-500))] focus:outline-none bg-white text-xs"
                   placeholder=" ">
            <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500">
                بحث في المستخدمين
            </label>
        </div>
    </div>

    <!-- نافذة إضافة/تعديل المستخدم -->
    @if($showAddForm)
    <div class="fixed inset-0 z-50 bg-black/10 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6 relative transform transition-all duration-300">
            <button wire:click="$set('showAddForm', false)"
                    class="absolute top-3 left-3 text-gray-400 hover:text-red-500 text-xl font-bold">
                &times;
            </button>

            <h3 class="text-xl font-bold mb-4 text-center" style="color: rgb(var(--primary-700));">
                {{ $editingUser ? 'تعديل المستخدم' : 'إضافة مستخدم جديد' }}
            </h3>
            
            <!-- تحت عنوان إدارة المستخدمين -->
            <div class="mb-4 px-4 py-2 rounded-lg text-xs" style="background-color: rgba(var(--primary-100), 0.5); border: 1px solid rgba(var(--primary-200), 0.5); color: rgb(var(--primary-700));">
                ملاحظة: يمكنك إضافة عدد غير محدود من المستخدمين، ولكن لن يتمكن سوى {{ auth()->user()->agency->max_users }} مستخدم من أن يكونوا نشطين في نفس الوقت.
            </div>

            <form wire:submit.prevent="{{ $editingUser ? 'updateUser' : 'addUser' }}" class="space-y-4 text-sm">
                @if(session('error'))
                    <div class="bg-red-100 border border-red-300 text-red-700 text-xs px-4 py-2 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif
                @php
                    $fieldClass = 'w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-[rgb(var(--primary-500))] focus:border-[rgb(var(--primary-500))] focus:outline-none bg-white text-xs peer';
                    $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-[rgb(var(--primary-600))]';
                    $containerClass = 'relative mt-1';
                @endphp

                <!-- الاسم -->
                <div class="{{ $containerClass }}">
                    <input wire:model="name" type="text" class="{{ $fieldClass }}" placeholder="الاسم" />
                    <label class="{{ $labelClass }}">الاسم</label>
                    @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div class="{{ $containerClass }}">
                    <input wire:model="email" type="email" class="{{ $fieldClass }}" placeholder="البريد الإلكتروني" />
                    <label class="{{ $labelClass }}">البريد الإلكتروني</label>
                    @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- كلمة المرور -->
                <div class="{{ $containerClass }}">
                    <input wire:model="password" type="password" class="{{ $fieldClass }}" 
                           placeholder="{{ $editingUser ? 'كلمة المرور الجديدة (اختياري)' : 'كلمة المرور' }}" />
                    <label class="{{ $labelClass }}">{{ $editingUser ? 'كلمة مرور جديدة' : 'كلمة المرور' }}</label>
                    @error('password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- نوع المستخدم -->
                <div class="{{ $containerClass }}">
                    <select wire:model="user_type" class="{{ $fieldClass }}">
                        <option value="agency_user">مستخدم عادي</option>
                        <option value="agency_admin">مدير وكالة</option>
                    </select>
                    <label class="{{ $labelClass }}">نوع المستخدم</label>
                    @error('user_type') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الدور -->
                <div class="{{ $containerClass }}">
                    <select wire:model="role_id" class="{{ $fieldClass }}">
                        <option value="">بدون دور</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <label class="{{ $labelClass }}">الدور</label>
                    @error('role_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الحالة -->
                <div class="flex items-center mt-4">
                    <input wire:model="is_active" type="checkbox" id="is_active" 
                        class="h-4 w-4 rounded border-gray-300 focus:ring-[rgb(var(--primary-500))] accent-[rgb(var(--primary-500))] checked:text-white bg-[rgb(var(--primary-500))] text-white">
                    <label for="is_active" class="mr-2 text-xs text-gray-700">نشط</label>
                </div>

                <!-- الأزرار -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" wire:click="$set('showAddForm', false)"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-2 rounded-xl shadow transition duration-300 text-sm">
                        إلغاء
                    </button>
                    <button type="submit"
                            class="text-white font-bold px-4 py-2 rounded-xl shadow-md transition duration-300 text-sm"
                            style="background: linear-gradient(to right, rgb(var(--primary-500)) 0%, rgb(var(--primary-600)) 100%);">
                        {{ $editingUser ? 'تحديث' : 'إضافة' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- جدول المستخدمين -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-2 py-1">المستخدم</th>
                        <th class="px-2 py-1">البريد الإلكتروني</th>
                        <th class="px-2 py-1">النوع</th>
                        <th class="px-2 py-1">الدور</th>
                        <th class="px-2 py-1">الحالة</th>
                        <th class="px-2 py-1">تاريخ الإضافة</th>
                        <th class="px-2 py-1">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 py-1">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full flex items-center justify-center mr-2"
                                        style="background: linear-gradient(to right, rgba(var(--primary-500), 0.1), rgba(var(--primary-600), 0.2));">
                                        <span class="font-semibold text-xs" style="color: rgb(var(--primary-500));">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <div class="text-xs font-medium">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                <span class="text-xs">{{ $user->email }}</span>
                            </td>
                            <td class="px-2 py-1">
                                <span class="inline-flex px-1.5 py-0.5 text-2xs font-semibold rounded-full 
                                    {{ $user->user_type === 'agency_admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->user_type === 'agency_admin' ? 'مدير' : 'مستخدم' }}
                                </span>
                            </td>
                            <td class="px-2 py-1">
                                @if($user->role)
                                    <span class="inline-flex px-1.5 py-0.5 text-2xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="text-2xs text-gray-500">بدون دور</span>
                                @endif
                            </td>
                            <td class="px-2 py-1">
                            <button wire:click="toggleUserStatus({{ $user->id }})"
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full"
                                    style="{{ $user->is_active 
                                        ? 'background-color: rgba(var(--primary-500), 0.1); color: rgb(var(--primary-500));' 
                                        : 'background-color: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68);' }}">
                                {{ $user->is_active ? 'نشط' : 'غير نشط' }}
                            </button>
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                <span class="text-xs">{{ $user->created_at->format('Y-m-d') }}</span>
                            </td>
                            <td class="px-2 py-1 whitespace-nowrap">
                                <div class="flex gap-2">
                                    <button wire:click="editUser({{ $user->id }})"
                                            class="font-medium text-xs" style="color: rgb(var(--primary-600)); hover:color: rgb(var(--primary-800));">
                                        تعديل
                                    </button>
                                    <button wire:click="deleteUser({{ $user->id }})"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')"
                                            class="text-red-600 hover:text-red-800 font-medium text-xs">
                                        حذف
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-400">
                                لا يوجد مستخدمين مسجلين حالياً
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
            <div class="px-4 py-2 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- رسائل النظام -->
    @if(session()->has('message'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 2000)"
             x-show="show"
             x-transition
             class="fixed bottom-4 right-4 text-white px-4 py-2 rounded-md shadow text-sm" 
             style="background-color: rgb(var(--primary-500));">
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
            color: rgb(var(--primary-600));
        }

        /* تأثير hover لزر "إضافة مستخدم جديد" */
        button[wire\:click="\$set('showAddForm', true)"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--primary-500), 0.2);
        }

        button[wire\:click="\$set('showAddForm', true)"]:active {
            transform: translateY(0);
        }
        
        /* تأثير زر الحفظ في النافذة المنبثقة */
        form button[type="submit"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(var(--primary-500), 0.2);
        }

        form button[type="submit"]:active {
            transform: translateY(0);
        }

    </style>
</div>