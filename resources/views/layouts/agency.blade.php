<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
    <title>{{ $title ?? 'إدارة الوكالة' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-emerald-600 to-teal-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo and Agency Name -->
                <div class="flex items-center">
                    <div class="flex items-center">
                        <!-- الأيقونة الدائرية المحسنة مع حواف ظاهرة دائمًا -->
                        <div class="relative mr-3">
                            <div class="h-10 w-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border-2 border-white/40 shadow-lg">
                                <svg class="h-6 w-6 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div class="absolute inset-0 rounded-full border-2 border-white/30 opacity-30 hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <div>
                            <h1 class="text-xl font-bold text-white">{{ Auth::user()->agency->name ?? 'إدارة الوكالة' }}</h1>
                            <p class="text-xs text-white/80">
                                @if(Auth::user()->isAgencyAdmin())
                                    لوحة تحكم مدير الوكالة
                                @elseif(Auth::user()->isAgencyUser())
                                    لوحة تحكم مستخدم الوكالة
                                @else
                                    لوحة تحكم الوكالة
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Main Navigation Links -->
                @php
                    $current = Route::currentRouteName();
                @endphp

                <div class="hidden md:flex items-center space-x-6 space-x-reverse">
                    <a href="{{ route('agency.dashboard') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.dashboard')
                            <span class="text-white font-bold">لوحة التحكم</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('agency.users') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.users')
                            <span class="text-white font-bold">المستخدمين</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h5" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('agency.roles') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.roles')
                            <span class="text-white font-bold">الأدوار</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h6" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('sales.index') }}" class="flex flex-col items-center group">
                        @if($current == 'sales.index')
                            <span class="text-white font-bold">المبيعات</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16l4-4m0 0l-4-4m4 4H9" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('agency.services') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.services')
                            <span class="text-white font-bold">الخدمات</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h6" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('agency.permissions') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.permissions')
                            <span class="text-white font-bold">الصلاحيات</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        @endif
                    </a>

                    <a href="{{ route('agency.profile') }}" class="flex flex-col items-center group">
                        @if($current == 'agency.profile')
                            <span class="text-white font-bold">ملف الوكالة</span>
                            <div class="h-1 w-6 bg-white rounded-full mt-1"></div>
                        @else
                            <div class="p-2 rounded-full border-2 border-white/20 group-hover:border-white/40 transition-all duration-200">
                                <svg class="h-6 w-6 text-white group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        @endif
                    </a>
                </div>

                <!-- User Info and Logout -->
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="h-8 w-8 bg-white/20 rounded-full flex items-center justify-center border-2 border-white/30 shadow-sm">
                            <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-white font-medium text-sm">{{ Auth::user()->name }}</span>
                            <p class="text-xs text-white/80">
                                @if(Auth::user()->isAgencyAdmin())
                                    مدير الوكالة
                                @elseif(Auth::user()->isAgencyUser())
                                    مستخدم الوكالة
                                @else
                                    مستخدم
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="w-px h-6 bg-white/30 mx-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center border-2 border-white/20 hover:border-white/40">
                            <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            تسجيل الخروج
                        </button>
=======
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'إدارة الوكالة' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body.bg-dashboard {
            background: #e7e8fd !important;
        }
    </style>
</head>
<body class="bg-dashboard min-h-screen font-app">
    <!-- Navigation/Header -->
    <nav class="topbar-main" style="background: linear-gradient(90deg, #05997a 0%, #068a8a 100%);">
        <!-- Logo & Agency Name -->
        <div class="flex items-center gap-3">
            <!-- Modern Company Icon -->
            <svg class="h-11 w-11" viewBox="0 0 32 32" fill="none">
                <rect x="2" y="8" width="28" height="20" rx="6" fill="#28A745"/>
                <rect x="8" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="14" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="20" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="12" y="22" width="8" height="4" rx="2" fill="#3CCFCF"/>
            </svg>
            <span class="topbar-company">{{ Auth::user()->agency->name ?? 'Travel X' }}</span>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex items-center gap-2 sm:gap-4">
            <a href="{{ route('agency.dashboard') }}" class="topbar-nav-btn {{ request()->routeIs('agency.dashboard') ? 'active' : '' }}" title="لوحة التحكم">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v11a1 1 0 01-1 1h-3m-4 0h4"></path></svg>
                <span class="topbar-nav-text">لوحة التحكم</span>
            </a>
            <a href="{{ route('agency.users') }}" class="topbar-nav-btn {{ request()->routeIs('agency.users') ? 'active' : '' }}" title="المستخدمين">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M17 20h5v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2h5"/></svg>
                <span class="topbar-nav-text">المستخدمين</span>
            </a>
            <a href="{{ route('agency.roles') }}" class="topbar-nav-btn {{ request()->routeIs('agency.roles') ? 'active' : '' }}" title="الأدوار">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6h6"/></svg>
                <span class="topbar-nav-text">الأدوار</span>
            </a>
            <a href="{{ route('sales.index') }}" class="topbar-nav-btn {{ request()->routeIs('sales.index') ? 'active' : '' }}" title="المبيعات">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3M17 16l4-4m0 0l-4-4m4 4H9" /></svg>
                <span class="topbar-nav-text">المبيعات</span>
            </a>
            <a href="{{ route('agency.services') }}" class="topbar-nav-btn {{ request()->routeIs('agency.services') ? 'active' : '' }}" title="الخدمات">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h6" /></svg>
                <span class="topbar-nav-text">الخدمات</span>
            </a>
            <a href="{{ route('agency.permissions') }}" class="topbar-nav-btn {{ request()->routeIs('agency.permissions') ? 'active' : '' }}" title="الصلاحيات">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span class="topbar-nav-text">الصلاحيات</span>
            </a>
            <a href="{{ route('agency.profile') }}" class="topbar-nav-btn {{ request()->routeIs('agency.profile') ? 'active' : '' }}" title="ملف الوكالة">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                <span class="topbar-nav-text">ملف الوكالة</span>
            </a>
        </div>
        <!-- Language & User -->
        <div class="flex items-center gap-3 sm:gap-5">
            <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-white/10">
                <svg class="h-6 w-6 rounded-full" viewBox="0 0 24 24"><rect width="24" height="24" fill="#fff"/><path d="M0 0h24v24H0z" fill="#00247d"/><path d="M0 0l24 24M24 0L0 24" stroke="#fff" stroke-width="2"/><path d="M0 0l24 24M24 0L0 24" stroke="#cf142b" stroke-width="1"/><rect x="10" width="4" height="24" fill="#fff"/><rect y="10" width="24" height="4" fill="#fff"/><rect x="11" width="2" height="24" fill="#cf142b"/><rect y="11" width="24" height="2" fill="#cf142b"/></svg>
            </span>
            <!-- Dropdown User -->
            <div class="relative group-user-dropdown" tabindex="0">
                <button class="inline-flex items-center justify-center h-10 w-10 rounded-full border-2 border-[#28A745] bg-white/10 focus:outline-none focus:ring-2 focus:ring-[#3CCFCF]" tabindex="0">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" fill="#28A745"/>
                        <rect x="5" y="15" width="14" height="6" rx="3" fill="#3CCFCF"/>
                        <circle cx="12" cy="8" r="3.2" fill="#fff"/>
                    </svg>
                </button>
                <div class="user-dropdown-menu">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="font-bold text-gray-800 text-base">{{ Auth::user()->name ?? 'User Name' }}</div>
                        <div class="text-xs text-gray-500 mt-1">{{ Auth::user()->role->name ?? 'الدور غير محدد' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="w-full text-right px-4 py-2 text-red-600 hover:bg-red-50 font-semibold transition">تسجيل الخروج</button>
>>>>>>> origin/anas
                    </form>
                </div>
            </div>
        </div>
    </nav>
<<<<<<< HEAD

    <!-- Main Content -->
    <main class="w-full px-4 py-6 sm:px-6 lg:px-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8">
            {{ $slot }}
        </div>
    </main>

=======
    <!-- Main Content (Full Width) -->
    <div class="flex-1">
        <div class="w-full px-0 py-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8 w-full">
                {{ $slot }}
            </div>
        </div>
    </div>
>>>>>>> origin/anas
    @livewireScripts
</body>
</html>