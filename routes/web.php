<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Agencies as AdminAgencies;
use App\Livewire\Admin\AddAgency as AdminAddAgency;
use App\Livewire\Agency\Dashboard as AgencyDashboard;
use App\Livewire\Agency\Users as AgencyUsers;
use App\Livewire\Agency\Roles as AgencyRoles;
use App\Livewire\Agency\Permissions as AgencyPermissions;
use App\Livewire\Agency\Profile as AgencyProfile;
use App\Livewire\Sales\Index;
use App\Livewire\Sales\Create;
use App\Livewire\Agency\SetupCurrency;
use App\Http\Controllers\CurrencySetupController;
use App\Livewire\Agency\AddCustomer;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');

// Dashboard redirect route
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isSuperAdmin()) {
        return redirect('/admin/dashboard');
    } elseif ($user->isAgencyAdmin() || $user->isAgencyUser()) {
        return redirect('/agency/dashboard');
    }

    return redirect('/');
})->middleware('auth')->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/agencies', AdminAgencies::class)->name('admin.agencies');
    Route::get('/agencies/add', AdminAddAgency::class)->name('admin.add-agency');
    Route::get('/agencies/edit/{id}', \App\Livewire\Admin\EditAgency::class)->name('admin.edit-agency');
    Route::get('/agencies/delete/{id}', \App\Livewire\Admin\DeleteAgency::class)->name('admin.delete-agency');
});

// Routes لإعداد العملة
Route::middleware(['auth'])->group(function () {
    Route::get('/setup-currency', [CurrencySetupController::class, 'form'])->name('agency.currency.setup');
    Route::post('/setup-currency', [CurrencySetupController::class, 'store'])->name('agency.currency.store');
});

// Agency Routes
Route::middleware(['auth', 'agency'])->prefix('agency')->group(function () {

    // صفحة إعداد العملة بـ Livewire، في حال ما تم إعداد العملة
    Route::get('/setup-currency', SetupCurrency::class)->name('agency.setup-currency');

    // باقي الصفحات محمية بميدلوير التحقق من إعداد العملة
    Route::middleware(['ensureCurrency'])->group(function () {
        Route::get('/dashboard', AgencyDashboard::class)->name('agency.dashboard');
        Route::get('/users', AgencyUsers::class)->name('agency.users');
        Route::get('/roles', AgencyRoles::class)->name('agency.roles');
        Route::get('/permissions', AgencyPermissions::class)->name('agency.permissions');
        Route::get('/profile', AgencyProfile::class)->name('agency.profile');
        Route::get('/services', \App\Livewire\Agency\Services::class)->name('agency.services');
        Route::get('/sales', Index::class)->name('sales.index');
        Route::get('/sales/create', Create::class)->name('sales.create');
         Route::get('/agency/customers/add', AddCustomer::class)->name('agency.customers.add');
    });
});

// Logout Route
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// Password Reset
Route::get('/forgot-password', \App\Livewire\ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', \App\Livewire\ResetPassword::class)->name('password.reset');
