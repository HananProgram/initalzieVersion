<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // مشاركة متغير theme_color مع جميع واجهات blade
        view()->composer('*', function ($view) {
            if (auth()->check() && auth()->user()->agency) {
                $view->with('themeColor', auth()->user()->agency->theme_color ?? 'emerald');
            }
        });
    }
}
