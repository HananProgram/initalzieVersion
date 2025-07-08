
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'إدارة الوكالة' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
<style>
    /* أنماط الأيقونات المغلقة والتحويم */
    .nav-item {
        transition: all 0.2s ease;
    }
    
    .nav-item.active {
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .nav-item:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .nav-text {
        transition: opacity 0.2s ease, max-width 0.2s ease;
        opacity: 0;
        max-width: 0;
        overflow: hidden;
    }
    
    .nav-item.active .nav-text,
    .nav-item:hover .nav-text {
        opacity: 1;
        max-width: 100px;
    }
    
    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.2s ease;
    }
    
    .nav-item:hover .nav-icon,
    .nav-item.active .nav-icon {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
    <x-theme-provider />

</head>
<body class="bg-dashboard min-h-screen font-app">
    <!-- Navigation/Header -->
<!-- Navigation/Header -->
<nav class="w-full flex items-center justify-between px-6 shadow-sm rounded-t-2xl nav-gradient"
     style="padding-top: 8px; padding-bottom: 8px; min-height:48px;">

        <!-- Logo & Agency Name -->
        <div class="flex items-center gap-3">
            <svg class="h-9 w-9" viewBox="0 0 32 32" fill="none">
                <rect x="2" y="8" width="28" height="20" rx="6" fill="rgb(var(--primary-500))"/>
                <rect x="8" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="14" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="20" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="12" y="22" width="8" height="4" rx="2" fill="rgb(var(--primary-600))"/>
            </svg>
            <span class="text-white text-lg font-bold tracking-tight">{{ Auth::user()->agency->name ?? 'Travel X' }}</span>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center gap-1 sm:gap-2 h-full">
            <!-- الرئيسية -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.dashboard') ? 'active' : '' }}">
                <a href="{{ route('agency.dashboard') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v11a1 1 0 01-1 1h-3m-4 0h4"></path>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الرئيسية</span>
                </a>
                <!-- قائمة فرعية -->
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">لوحة عامة</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            إحصائيات سريعة
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <!-- قائمة فرعية متشعبة -->
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إحصائية 1</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إحصائية 2</a>
                        </div>
                    </div>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">آخر التحديثات</a>
                </div>
            </div>
            <!-- المستخدمين -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.users') ? 'active' : '' }}">
                <a href="{{ route('agency.users') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M17 20h5v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h5"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">المستخدمين</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">قائمة المستخدمين</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            إضافة مستخدم
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إضافة فردي</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إضافة جماعي</a>
                        </div>
                    </div>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">صلاحيات المستخدمين</a>
                </div>
            </div>
            <!-- الأدوار -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.roles') ? 'active' : '' }}">
                <a href="{{ route('agency.roles') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6h6"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الأدوار</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">جميع الأدوار</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إضافة دور جديد</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            صلاحيات الأدوار
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">عرض الصلاحيات</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تعديل الصلاحيات</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- المبيعات -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('sales.index') ? 'active' : '' }}">
                <a href="{{ route('sales.index') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16l4-4m0 0l-4-4m4 4H9"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">المبيعات</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">سجل المبيعات</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تقرير المبيعات</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            إضافة عملية بيع
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">بيع نقدي</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">بيع آجل</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- الخدمات -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.services') ? 'active' : '' }}">
                <a href="{{ route('agency.services') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h6"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الخدمات</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">جميع الخدمات</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إضافة خدمة</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            أنواع الخدمات
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">خدمة 1</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">خدمة 2</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- الصلاحيات -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.permissions') ? 'active' : '' }}">
                <a href="{{ route('agency.permissions') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الصلاحيات</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إدارة الصلاحيات</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تقارير الصلاحيات</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            سجل التعديلات
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تعديل 1</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تعديل 2</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- الموارد البشرية -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('hr.employees.index') ? 'active' : '' }}">
                <a href="{{ route('hr.employees.index') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.938 11.938 0 0112 15c2.21 0 4.265.64 6.001 1.737M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الموارد البشرية</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">الموظفون</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            الحضور والانصراف
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تقرير حضور</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تقرير انصراف</a>
                        </div>
                    </div>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">الرواتب</a>
                </div>
            </div>
            <!-- المزودين -->
<div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.providers') ? 'active' : '' }}">
    <a href="{{ route('agency.providers') }}" class="flex items-center">
        <span class="nav-icon">
            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"/>
            </svg>
        </span>
        <span class="nav-text text-xs text-white whitespace-nowrap mr-2">المزودين</span>
    </a>
    <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
        <a href="{{ route('agency.providers') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">جميع المزودين</a>
        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">إضافة مزود</a>
        <div class="relative group/sub">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                أنواع المزودين
                <span class="ml-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            </a>
            <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">شركات طيران</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">فنادق</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">سيارات</a>
            </div>
        </div>
    </div>
</div>

            <!-- إضافة عميل -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.customers.add') ? 'active' : '' }}">
                <a href="{{ route('agency.customers.add') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">إضافة عميل</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">عملاء جدد</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">بحث عن عميل</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            تصدير العملاء
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تصدير PDF</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">تصدير Excel</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- إضافة حساب -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.accounts') ? 'active' : '' }}">
                <a href="{{ route('agency.accounts') }}" class="flex items-center">
                    <span class="nav-icon">
                        <!-- أيقونة المحفظة (Wallet Icon) -->
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m4-3h-6m6 0a2 2 0 01-2 2h-4a2 2 0 010-4h4a2 2 0 012 2z" />
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">الحسابات</span>
                </a>
            </div>
            <!-- ملف الوكالة -->
            <div class="relative group nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.profile') ? 'active' : '' }}">
                <a href="{{ route('agency.profile') }}" class="flex items-center">
                    <span class="nav-icon">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </span>
                    <span class="nav-text text-xs text-white whitespace-nowrap mr-2">ملف الوكالة</span>
                </a>
                <div class="absolute right-0 top-full mt-2 min-w-[180px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">بيانات الوكالة</a>
                    <div class="relative group/sub">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex justify-between items-center">
                            الوثائق الرسمية
                            <span class="ml-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="absolute right-full top-0 mt-0 min-w-[160px] bg-white rounded-xl shadow-lg py-2 z-50 hidden group-hover/sub:block">
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">وثيقة 1</a>
                            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">وثيقة 2</a>
                        </div>
                    </div>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">سجل التعديلات</a>
                </div>
            </div>

            <div class="nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('agency.dynamic-lists') ? 'active' : '' }}">
    <a href="{{ route('agency.dynamic-lists') }}" class="flex items-center">
        <span class="nav-icon">
            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </span>
        <span class="nav-text text-xs text-white whitespace-nowrap mr-2">قوائم</span>
    </a>
</div>

        </div>

        <!-- Theme Selector -->
        <x-theme-selector />
        <!-- Language & User -->
        <div class="flex items-center gap-2 sm:gap-4">
            <span class="flex items-center justify-center h-10 w-10 rounded-full bg-white/10">
                <svg class="h-6 w-6 rounded-full" viewBox="0 0 24 24"><rect width="24" height="24" fill="#fff"/><path d="M0 0h24v24H0z" fill="#00247d"/><path d="M0 0l24 24M24 0L0 24" stroke="#fff" stroke-width="2"/><path d="M0 0l24 24M24 0L0 24" stroke="#cf142b" stroke-width="1"/><rect x="10" width="4" height="24" fill="#fff"/><rect y="10" width="24" height="4" fill="#fff"/><rect x="11" width="2" height="24" fill="#cf142b"/><rect y="11" width="24" height="2" fill="#cf142b"/></svg>
            </span>
            <!-- Dropdown User -->
            <div class="relative group-user-dropdown" tabindex="0">
                <button class="flex items-center justify-center h-10 w-10 rounded-full border-2 border-theme bg-white/10 focus:outline-none focus:ring-2 focus-ring-theme">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" fill="#28A745"/>
                        <rect x="5" y="15" width="14" height="6" rx="3" fill="#3CCFCF"/>
                        <circle cx="12" cy="8" r="3.2" fill="#fff"/>
                    </svg>
                </button>
                <div class="user-dropdown-menu left-0 right-auto mt-2" style="min-width: 180px;">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="font-bold text-gray-800 text-base">{{ Auth::user()->name ?? 'User Name' }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ Auth::user()->role->name ?? 'الدور غير محدد' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full text-right px-4 py-2 text-red-600 hover:bg-red-50 font-semibold transition">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <style>
        .nav-gradient {
            background: linear-gradient(90deg, rgb(var(--primary-500)) 0%, rgb(var(--primary-600)) 100%);
        }
        .group-user-dropdown:focus-within .user-dropdown-menu,
        .group-user-dropdown:hover .user-dropdown-menu {
            display: block;
        }
        .user-dropdown-menu {
            display: none;
            position: absolute;
            left: 0;
            right: auto;
            top: 110%;
            margin-top: 8px;
            min-width: 180px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
            z-index: 50;
        }
        /* دعم القوائم الفرعية المتشعبة */
        .group:hover .group-hover\2f block { display: block !important; }
        .group\/sub:hover .group-hover\/sub\:block { display: block !important; }

    </style>

    <!-- Main Content (Full Width) -->
    <div class="flex-1">
        <div class="w-full px-0 py-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8 w-full">
                {{ $slot }}
            </div>
        </div>
    </div>
    @livewireScripts
<script>
function updateTheme(theme) {
    fetch('/update-theme', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ theme_color: theme })
    })
    .then(response => {
        if (response.ok) {
            window.location.reload();
        } else {
            alert('حدث خطأ أثناء تغيير اللون');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ في الاتصال');
    });
}

// إغلاق القائمة عند النقر خارجها
document.addEventListener('click', function(e) {
    if (!e.target.closest('.group-theme-selector')) {
        document.querySelector('.theme-selector-menu').classList.add('hidden');
    }
});

// فتح/إغلاق القائمة
document.querySelector('.group-theme-selector button').addEventListener('click', function(e) {
    e.stopPropagation();
    document.querySelector('.theme-selector-menu').classList.toggle('hidden');
});
</script>
</body>
</html>