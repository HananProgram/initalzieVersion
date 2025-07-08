<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'إدارة الوكالات' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body.bg-dashboard {
            background: #e7e8fd !important;
        }
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
        .group:hover .group-hover\:block { display: block !important; }
        .group\/sub:hover .group-hover\/sub\:block { display: block !important; }
        
        /* أنماط أداة اختيار الثيم */
        .group-theme-selector:focus-within .theme-selector-menu,
        .group-theme-selector:hover .theme-selector-menu {
            display: block;
        }
        .theme-selector-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0.5rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 50;
            width: 200px;
            padding: 0.5rem 0;
        }
        .theme-option {
            padding: 0.5rem 1rem;
            text-align: right;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .theme-option:hover {
            background-color: #f3f4f6;
        }
        .nav-gradient {
            background: linear-gradient(90deg, rgb(var(--primary-500)) 0%, rgb(var(--primary-600)) 100%);
        }
        .theme-selector-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    margin-top: 0.5rem;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    z-index: 50;
    padding: 0.75rem;
    min-width: 150px;
}

.theme-selector-menu button {
    cursor: pointer;
    outline: none;
}

    </style>
    <x-theme-provider />
</head>
<body class="bg-dashboard min-h-screen font-app">
    <!-- Navigation/Header -->
    <nav class="w-full flex items-center justify-between px-6 shadow-sm rounded-t-2xl nav-gradient"
         style="padding-top: 8px; padding-bottom: 8px; min-height:48px;">

        <!-- Logo & Company -->
        <div class="flex items-center gap-3">
            <!-- Modern Company Icon -->
            <svg class="h-9 w-9" viewBox="0 0 32 32" fill="none">
                <rect x="2" y="8" width="28" height="20" rx="6" fill="rgb(var(--primary-500))"/>
                <rect x="8" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="14" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="20" y="14" width="4" height="4" rx="1" fill="#fff"/>
                <rect x="12" y="22" width="8" height="4" rx="2" fill="rgb(var(--primary-600))"/>
            </svg>
            <span class="text-white text-lg font-bold tracking-tight">Travel X</span>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center gap-1 sm:gap-2 h-full">
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v11a1 1 0 01-1 1h-3m-4 0h4"></path>
                    </svg>
                </span>
                <span class="nav-text text-xs text-white whitespace-nowrap mr-2">لوحة التحكم</span>
            </a>
            
            <a href="{{ route('admin.agencies') }}" class="nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('admin.agencies*') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="7" width="18" height="13" rx="2"/>
                        <path d="M16 3v4M8 3v4M3 10h18"/>
                    </svg>
                </span>
                <span class="nav-text text-xs text-white whitespace-nowrap mr-2">إدارة الوكالات</span>
            </a>
            
            <a href="{{ route('admin.add-agency') }}" class="nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('admin.add-agency') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 8v6M23 11h-6"/>
                    </svg>
                </span>
                <span class="nav-text text-xs text-white whitespace-nowrap mr-2">إضافة وكالة</span>
            </a>

            <a href="{{ route('admin.dynamic-lists') }}" class="nav-item flex items-center px-2 py-1 rounded-full {{ request()->routeIs('admin.dynamic-lists') ? 'active' : '' }}">
                <span class="nav-icon">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </span>
                <span class="nav-text text-xs text-white whitespace-nowrap mr-2">القوائم</span>
            </a>
        </div>

        <!-- Right Side Controls -->
        <div class="flex items-center gap-2 sm:gap-4">
            <!-- Theme Selector for Super Admin -->
   <!-- Theme Selector for Super Admin -->
        @php
            use App\Services\ThemeService;
            $themes = auth()->user()?->isSuperAdmin() ? ThemeService::getThemeColors() : [];
        @endphp

        @if(auth()->user()->isSuperAdmin())
            <div class="relative group-theme-selector">
                <!-- زر الثيم -->
                <button class="flex items-center  gap-3 sm:gap-15 justify-center h-10 w-10 rounded-full bg-white/10 hover:bg-white/20 transition focus:outline-none">
                  

                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2m-4-4V5m0 4h4m-4 0H3"/>
                    </svg>
                </button>

                <!-- القائمة المنبثقة -->
                <div class="theme-selector-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 p-2 grid grid-cols-4 gap-2">
                    @foreach($themes as $name => $theme)
                        <button 
                            onclick="updateSystemTheme('{{ $name }}')" 
                            title="{{ ucfirst($name) }}"
                            class="h-8 w-8 rounded-full border-2 border-white shadow hover:scale-110 transition"
                            style="background-color: rgb({{ $theme['primary-500'] }});">
                        </button>
                    @endforeach
                </div>
            </div>
            @endif




            <!-- Language Selector -->
            <span class="flex items-center justify-center h-10 w-10 rounded-full bg-white/10">
                <svg class="h-6 w-6 rounded-full" viewBox="0 0 24 24"><rect width="24" height="24" fill="#fff"/><path d="M0 0h24v24H0z" fill="#00247d"/><path d="M0 0l24 24M24 0L0 24" stroke="#fff" stroke-width="2"/><path d="M0 0l24 24M24 0L0 24" stroke="#cf142b" stroke-width="1"/><rect x="10" width="4" height="24" fill="#fff"/><rect y="10" width="24" height="4" fill="#fff"/><rect x="11" width="2" height="24" fill="#cf142b"/><rect y="11" width="24" height="2" fill="#cf142b"/></svg>
            </span>
            
            <!-- User Dropdown -->
            <div class="relative group-user-dropdown" tabindex="0">
                <button class="flex items-center justify-center h-10 w-10 rounded-full border-2 border-theme bg-white/10 focus:outline-none focus:ring-2 focus-ring-theme">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" fill="rgb(var(--primary-500))"/>
                        <rect x="5" y="15" width="14" height="6" rx="3" fill="rgb(var(--primary-600))"/>
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
                    </form>
                </div>
            </div>
        </div>
    </nav>

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
  function updateSystemTheme(theme) {
    fetch('{{ route("admin.system.update-theme") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ theme_color: theme })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'حدث خطأ أثناء تغيير اللون');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert(error.message || 'حدث خطأ في الاتصال بالخادم');
    });
}
    // إغلاق القائمة عند النقر خارجها
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.group-theme-selector')) {
            document.querySelector('.theme-selector-menu').classList.add('hidden');
        }
    });

    // فتح/إغلاق القائمة
    document.querySelector('.group-theme-selector button')?.addEventListener('click', function(e) {
        e.stopPropagation();
        document.querySelector('.theme-selector-menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>