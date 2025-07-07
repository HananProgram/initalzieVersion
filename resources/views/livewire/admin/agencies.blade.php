@php
    use App\Services\ThemeService;

    $themeName = ThemeService::getSystemTheme();
    $colors = ThemeService::getCurrentThemeColors($themeName);
@endphp

<div>
<div class="flex flex-col h-screen overflow-hidden">
    <!-- القسم العلوي الثابت -->
    <div class="flex-none p-4 bg-gray-50">
        <!-- عنوان الصفحة -->
        <div class="mb-6">
          <h2 class="text-2xl font-bold mb-2 text-gray-900">إدارة الوكالات</h2>
            <p class="text-gray-600 text-sm">عرض وإدارة جميع الوكلات المسجلة في النظام</p>
        </div>

        <!-- بطاقة البحث والإجراءات -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- حقل البحث -->
                <div class="relative w-full md:w-1/3">
                    <input type="text" wire:model.debounce.500ms="search"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 pr-10 focus:ring-2 focus:outline-none bg-white text-sm"
                           placeholder="ابحث عن وكالة...">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- أزرار الإجراءات -->
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    @if(!$showAll)
                        <select wire:model="perPage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:outline-none">
                            <option value="10">10 صفوف</option>
                            <option value="25">25 صف</option>
                            <option value="50">50 صف</option>
                            <option value="100">100 صف</option>
                        </select>
                    @endif

                    <button wire:click="toggleShowAll"
                            class="text-white px-4 py-2 rounded-lg font-medium text-sm transition duration-100 shadow hover:shadow-md whitespace-nowrap"
                            style="background: linear-gradient(to right, rgb({{ $colors['primary-500'] }}), rgb({{ $colors['primary-600'] }}));">
                        {{ $showAll ? 'عرض الصفحات' : 'عرض الكل' }}
                    </button>

                    <a href="{{ route('admin.add-agency') }}"
                       class="text-white px-4 py-2 rounded-lg font-medium text-sm transition duration-100 shadow hover:shadow-md whitespace-nowrap"
                       style="background: linear-gradient(to right, rgb({{ $colors['primary-500'] }}), rgb({{ $colors['primary-600'] }}));">
                        إضافة وكالة جديدة
                    </a>
                </div>
            </div>
        </div>

        <!-- رسائل التنبيه -->
        @if(session('message'))
            <div class="mt-4 p-3 bg-emerald-100 border border-emerald-100 text-emerald-800 rounded-lg text-center text-sm">
                {{ session('message') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-4 p-3 bg-red-100 border border-red-100 text-red-800 rounded-lg text-center text-sm">
                {{ session('error') }}
            </div>
        @endif
        @if(isset($successMessage) && $successMessage)
            <div class="mt-4 p-3 bg-emerald-100 border border-emerald-100 text-emerald-800 rounded-lg text-center text-sm">
                {{ $successMessage }}
            </div>
        @endif
    </div>

    <!-- القسم السفلي مع الجدول -->
    <div class="flex-1 overflow-hidden px-4 pb-4">
        <div class="bg-white rounded-xl shadow-md h-full flex flex-col">
            <div class="overflow-y-auto flex-1">
                <table class="min-w-full divide-y divide-gray-100 text-xs text-right">
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
                            <th class="px-3 py-2 whitespace-nowrap">بداية الاشتراك</th>
                            <th class="px-3 py-2 whitespace-nowrap">نهاية الاشتراك</th>
                            <th class="px-3 py-2 whitespace-nowrap">المستخدمين</th>
                            <th class="px-3 py-2 whitespace-nowrap">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($agencies as $agency)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">
                                    @if($agency->logo)
                                        <img src="{{ asset('storage/'.$agency->logo) }}" class="h-8 w-8 rounded-full object-cover" alt="شعار الوكالة">
                                    @else
                                        <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <span class="px-2 py-1 rounded-full text-xs font-medium"
                                        style="background-color: rgba({{ $colors['primary-100'] }}, 0.5); color: rgb({{ $colors['primary-500'] }});">
                                        نشطة
                                    </span>

                                    @elseif($agency->status == 'inactive')
                                        <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">غير نشطة</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">موقوفة</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">{{ $agency->license_expiry_date->format('Y-m-d') }}</td>
                                <td class="px-3 py-2">{{ optional($agency->subscription_start_date)->format('Y-m-d') ?? '—' }}</td>
                                <td class="px-3 py-2">{{ optional($agency->subscription_end_date)->format('Y-m-d') ?? '—' }}</td>
                                <td class="px-3 py-2 text-center">{{ $agency->max_users }}</td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <button wire:click="showEditModal({{ $agency->id }})"
                                        class="text-white px-3 py-1 rounded-lg font-medium text-xs transition duration-100 shadow hover:shadow-md"
                                        style="background: linear-gradient(to right, rgb({{ $colors['primary-500'] }}), rgb({{ $colors['primary-600'] }}));">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="16" class="text-center py-4 text-gray-500">لا توجد وكلات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(!$showAll)
                <div class="px-4 py-3 border-t border-gray-100 bg-gray-50">
                    {{ $agencies->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    input:focus, select:focus, textarea:focus {
        border-color: rgb({{ $colors['primary-500'] }}) !important;
        box-shadow: 0 0 0 2px rgba({{ $colors['primary-500'] }}, 0.2) !important;
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
        color: rgb({{ $colors['primary-500'] }}) !important;
    }

    button[type="submit"]:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba({{ $colors['primary-500'] }}, 0.2);
    }

    button[type="submit"]:active {
        transform: translateY(0);
    }
</style>
</div>
