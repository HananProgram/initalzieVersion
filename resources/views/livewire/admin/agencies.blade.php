<div>
<div class="flex flex-col h-screen overflow-hidden">
    <!-- القسم العلوي الثابت -->
    <div class="flex-none p-4 bg-gray-50">
        <!-- عنوان الصفحة -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-emerald-700 mb-2">إدارة الوكلات</h2>
            <p class="text-gray-600 text-sm">عرض وإدارة جميع الوكلات المسجلة في النظام</p>
        </div>

        <!-- بطاقة البحث والإجراءات -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- حقل البحث -->
                <div class="relative w-full md:w-1/3">
                    <input type="text" wire:model.debounce.500ms="search" 
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-sm" 
                           placeholder="ابحث عن وكالة...">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- أزرار الإجراءات -->
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    @if(!$showAll)
                        <select wire:model="perPage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400">
                            <option value="10">10 صفوف</option>
                            <option value="25">25 صف</option>
                            <option value="50">50 صف</option>
                            <option value="100">100 صف</option>
                        </select>
                    @endif
                    
                    <button wire:click="toggleShowAll" 
                            class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition duration-200 shadow hover:shadow-md whitespace-nowrap">
                        {{ $showAll ? 'عرض الصفحات' : 'عرض الكل' }}
                    </button>
                    
                    <a href="{{ route('admin.add-agency') }}" 
                       class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-4 py-2 rounded-lg font-medium text-sm transition duration-200 shadow hover:shadow-md whitespace-nowrap">
                        إضافة وكالة جديدة
                    </a>
                </div>
            </div>
        </div>

        <!-- رسائل التنبيه -->
        @if(session('message'))
            <div class="mt-4 p-3 bg-emerald-100 border border-emerald-200 text-emerald-800 rounded-lg text-center text-sm">
                {{ session('message') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-4 p-3 bg-red-100 border border-red-200 text-red-800 rounded-lg text-center text-sm">
                {{ session('error') }}
            </div>
        @endif
        @if(isset($successMessage) && $successMessage)
            <div class="mt-4 p-3 bg-emerald-100 border border-emerald-200 text-emerald-800 rounded-lg text-center text-sm">
                {{ $successMessage }}
            </div>
        @endif
    </div>

    <!-- القسم السفلي مع الجدول القابل للتمرير -->
    <div class="flex-1 overflow-hidden px-4 pb-4">
        <div class="bg-white rounded-xl shadow-md h-full flex flex-col">
            <div class="overflow-y-auto flex-1">
                <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
                    <thead class="bg-gray-100 text-gray-600 sticky top-0 z-10">
                        <tr>
                            <th class="px-3 py-2 whitespace-nowrap">الشعار</th>
                            <th class="px-3 py-2 whitespace-nowrap">اسم الوكالة</th>
                            <th class="px-3 py-2 whitespace-nowrap">الفرع الرئيسي</th>
                            <th class="px-3 py-2 whitespace-nowrap">البريد الإلكتروني</th>
                            <th class="px-3 py-2 whitespace-nowrap">الهاتف</th>
                            <th class="px-3 py-2 whitespace-nowrap">العملة</th>
                            <th class="px-3 py-2 whitespace-nowrap">العنوان</th>
                            <th class="px-3 py-2 whitespace-nowrap">رقم الرخصة</th>
                            <th class="px-3 py-2 whitespace-nowrap">السجل التجاري</th>
                            <th class="px-3 py-2 whitespace-nowrap">الرقم الضريبي</th>
                            <th class="px-3 py-2 whitespace-nowrap">الحالة</th>
                            <th class="px-3 py-2 whitespace-nowrap">انتهاء الرخصة</th>
                            <th class="px-3 py-2 whitespace-nowrap">المستخدمين</th>
                            <th class="px-3 py-2 whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($agencies as $agency)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">
                                    @if($agency->logo)
                                        <img src="{{ asset('storage/'.$agency->logo) }}" class="h-8 w-8 rounded-full object-cover" alt="شعار الوكالة">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-3 py-2 font-medium">{{ $agency->name }}</td>
                                <td class="px-3 py-2">{{ $agency->main_branch_name }}</td>
                                <td class="px-3 py-2">{{ $agency->email }}</td>
                                <td class="px-3 py-2">
                                    <div>{{ $agency->phone }}</div>
                                    @if($agency->landline)
                                        <div class="text-xs text-gray-500">{{ $agency->landline }}</div>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ $agency->currency }}</td>
                                <td class="px-3 py-2 max-w-xs truncate">{{ $agency->address }}</td>
                                <td class="px-3 py-2">{{ $agency->license_number }}</td>
                                <td class="px-3 py-2">{{ $agency->commercial_record }}</td>
                                <td class="px-3 py-2">{{ $agency->tax_number }}</td>
                                <td class="px-3 py-2">
                                    @if($agency->status == 'active')
                                        <span class="px-2 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium">
                                            نشطة
                                        </span>
                                    @elseif($agency->status == 'inactive')
                                        <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">
                                            غير نشطة
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">
                                            موقوفة
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ $agency->license_expiry_date->format('Y-m-d') }}</td>
                                <td class="px-3 py-2 text-center">{{ $agency->max_users }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <button wire:click="showEditModal({{ $agency->id }})"
                                       class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-3 py-1 rounded-lg font-medium text-xs transition duration-200 shadow hover:shadow-md whitespace-nowrap">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="text-center py-4 text-gray-400">لا توجد وكلات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- الترقيم -->
            @if(!$showAll)
                <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
                    {{ $agencies->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- مودال التعديل --}}
@if($showEditModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center min-h-screen bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-4xl mx-4 relative animate-fade-in-up border-t-4 border-emerald-500">
            <button wire:click="$set('showEditModal', false)" class="absolute top-4 left-4 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>
            <h3 class="text-xl font-bold mb-6 text-emerald-600 text-center">تعديل بيانات الوكالة</h3>
            
            <form wire:submit.prevent="saveEdit" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- اسم الوكالة -->
                    <div class="relative">
                        <input type="text" wire:model.defer="agency_name" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">اسم الوكالة</label>
                        @error('agency_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- اسم الفرع الرئيسي -->
                    <div class="relative">
                        <input type="text" wire:model.defer="main_branch_name" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">اسم الفرع الرئيسي</label>
                        @error('main_branch_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- البريد الإلكتروني -->
                    <div class="relative">
                        <input type="email" wire:model.defer="agency_email" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">البريد الإلكتروني</label>
                        @error('agency_email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- رقم الهاتف -->
                    <div class="relative">
                        <input type="text" wire:model.defer="agency_phone" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">رقم الهاتف</label>
                        @error('agency_phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- الهاتف الثابت -->
                    <div class="relative">
                        <input type="text" wire:model.defer="landline" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">الهاتف الثابت</label>
                        @error('landline') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- العملة -->
                    <div class="relative">
                        <select wire:model.defer="currency" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer">
                            <option value="SAR">ريال سعودي (SAR)</option>
                            <option value="USD">دولار أمريكي (USD)</option>
                            <option value="EUR">يورو (EUR)</option>
                        </select>
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">العملة</label>
                        @error('currency') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- العنوان -->
                    <div class="relative">
                        <input type="text" wire:model.defer="agency_address" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">العنوان</label>
                        @error('agency_address') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- رقم الرخصة -->
                    <div class="relative">
                        <input type="text" wire:model.defer="license_number" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">رقم الرخصة</label>
                        @error('license_number') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- السجل التجاري -->
                    <div class="relative">
                        <input type="text" wire:model.defer="commercial_record" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">السجل التجاري</label>
                        @error('commercial_record') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- الرقم الضريبي -->
                    <div class="relative">
                        <input type="text" wire:model.defer="tax_number" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">الرقم الضريبي</label>
                        @error('tax_number') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- تاريخ انتهاء الرخصة -->
                    <div class="relative">
                        <input type="date" wire:model.defer="license_expiry_date" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">تاريخ انتهاء الرخصة</label>
                        @error('license_expiry_date') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- عدد المستخدمين -->
                    <div class="relative">
                        <input type="number" min="1" wire:model.defer="max_users" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" " />
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">عدد المستخدمين</label>
                        @error('max_users') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- حالة الوكالة -->
                    <div class="relative">
                        <select wire:model.defer="status" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer">
                            <option value="active">نشطة</option>
                            <option value="inactive">غير نشطة</option>
                            <option value="suspended">موقوفة</option>
                        </select>
                        <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">حالة الوكالة</label>
                        @error('status') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <!-- وصف الوكالة -->
                <div class="relative mt-4">
                    <textarea wire:model.defer="description" rows="2" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 peer" placeholder=" "></textarea>
                    <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">وصف الوكالة (اختياري)</label>
                    @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- أزرار الحفظ والإلغاء -->
                <div class="mt-6 flex justify-center gap-4">
                    <button type="submit" 
                            class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-8 py-2 rounded-lg font-bold text-sm transition duration-200 shadow-lg hover:shadow-xl">
                        حفظ التعديلات
                    </button>
                    <button type="button" wire:click="$set('showEditModal', false)" 
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-2 rounded-lg font-bold text-sm transition duration-200">
                        إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<style>
    html, body {
        height: 100%;
        overflow: hidden;
    }
    
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
    
    /* تحسين عرض الجدول على الشاشات الصغيرة */
    @media (max-width: 1024px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }
</style>
</div>