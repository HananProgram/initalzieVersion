<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'إدارة الوكالات' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
<<<<<<< HEAD
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-lg border-b border-emerald-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h1 class="text-xl font-bold text-emerald-600">نظام إدارة الوكالات</h1>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="flex items-center space-x-3 space-x-reverse">
                        <div class="h-8 w-8 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="w-px h-6 bg-gray-300 mx-2"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 shadow-lg hover:shadow-xl">
                            <svg class="h-4 w-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            تسجيل الخروج
                        </button>
=======
    <style>
        body.bg-dashboard {
            background: #e7e8fd !important;
        }
    </style>
</head>
<body class="bg-dashboard min-h-screen font-app">
    <!-- Navigation/Header -->
    <nav class="topbar-main" style="background: linear-gradient(90deg, #05997a 0%, #068a8a 100%);">
        <!-- Logo & Company -->
        <div class="flex items-center gap-3">
            <!-- Modern Company Icon -->
            <svg class="h-11 w-11" viewBox="0 0 32 32" fill="none">
                <rect x="2" y="8" width="28" height="20" rx="6" fill="#28A745"/>
                <rect x="8" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="14" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="20" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="12" y="22" width="8" height="4" rx="2" fill="#3CCFCF"/>
            </svg>
            <span class="topbar-company">Travel X</span>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex items-center gap-2 sm:gap-4">
            <a href="{{ route('admin.dashboard') }}" class="topbar-nav-btn {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="لوحة التحكم">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v11a1 1 0 01-1 1h-3m-4 0h4"></path></svg>
                <span class="topbar-nav-text">لوحة التحكم</span>
            </a>
            <a href="{{ route('admin.agencies') }}" class="topbar-nav-btn {{ request()->routeIs('admin.agencies*') ? 'active' : '' }}" title="إدارة الوكالات">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>
                <span class="topbar-nav-text">إدارة الوكالات</span>
            </a>
            <a href="{{ route('admin.add-agency') }}" class="topbar-nav-btn {{ request()->routeIs('admin.add-agency') ? 'active' : '' }}" title="إضافة وكالة">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M20 8v6M23 11h-6"/></svg>
                <span class="topbar-nav-text">إضافة وكالة</span>
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

    <!-- Sidebar and Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-72 bg-white/90 backdrop-blur-md shadow-2xl border-l border-emerald-100 min-h-screen">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-emerald-100">
                <div class="flex items-center">
                    <div class="h-12 w-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="mr-3">
                        <h2 class="text-lg font-bold text-gray-800">لوحة الإدارة</h2>
                        <p class="text-sm text-gray-500">السوبر أدمن</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-6">
                <div class="space-y-3">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 rounded-xl transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg' : '' }}">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-emerald-100 group-hover:bg-emerald-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">لوحة التحكم</span>
                        @if(request()->routeIs('admin.dashboard'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Agencies Management -->
                    <a href="{{ route('admin.agencies') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 rounded-xl transition duration-200 {{ request()->routeIs('admin.agencies*') ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg' : '' }}">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('admin.agencies*') ? 'bg-white/20' : 'bg-teal-100 group-hover:bg-teal-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('admin.agencies*') ? 'text-white' : 'text-teal-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إدارة الوكالات</span>
                        @if(request()->routeIs('admin.agencies*'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>

                    <!-- Add Agency -->
                    <a href="{{ route('admin.add-agency') }}" 
                       class="group flex items-center px-4 py-3 text-gray-700 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 hover:text-emerald-600 rounded-xl transition duration-200 {{ request()->routeIs('admin.add-agency') ? 'bg-gradient-to-r from-emerald-500 to-teal-500 text-white shadow-lg' : '' }}">
                        <div class="flex items-center justify-center h-10 w-10 rounded-lg {{ request()->routeIs('admin.add-agency') ? 'bg-white/20' : 'bg-cyan-100 group-hover:bg-cyan-200' }} transition duration-200">
                            <svg class="h-5 w-5 {{ request()->routeIs('admin.add-agency') ? 'text-white' : 'text-cyan-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <span class="mr-3 font-medium">إضافة وكالة</span>
                        @if(request()->routeIs('admin.add-agency'))
                            <div class="mr-auto w-2 h-2 bg-white rounded-full"></div>
                        @endif
                    </a>
                </div>

                <!-- Divider -->
                <div class="my-6 border-t border-emerald-100"></div>

                <!-- Quick Stats -->
                <div class="space-y-3">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">إحصائيات سريعة</h3>
                    
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl p-4 border border-emerald-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">إجمالي الوكالات</p>
                                <p class="text-2xl font-bold text-emerald-600">{{ \App\Models\Agency::count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-teal-50 to-cyan-50 rounded-xl p-4 border border-teal-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">إجمالي المستخدمين</p>
                                <p class="text-2xl font-bold text-teal-600">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="h-10 w-10 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8">
=======
    <!-- Main Content (Full Width) -->
    <div class="flex-1">
        <div class="w-full px-0 py-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-emerald-100 p-8 w-full">
>>>>>>> origin/anas
                {{ $slot }}
            </div>
        </div>
    </div>
<<<<<<< HEAD

    @livewireScripts
    <script>
        // Ensure Livewire is working
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            if (typeof Livewire !== 'undefined') {
                console.log('Livewire is available');
            } else {
                console.error('Livewire is not available');
            }
        });
    </script>
=======
    @livewireScripts
>>>>>>> origin/anas
</body>
</html> 