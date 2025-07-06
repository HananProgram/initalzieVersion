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
use App\Livewire\Agency\AddCustomer;
use App\Livewire\Agency\SetupCurrency;
use App\Livewire\Agency\ChangePassword;
use App\Livewire\Sales\Index;
use App\Livewire\Sales\Create;
use App\Http\Controllers\CurrencySetupController;
use App\Livewire\HR\EmployeeIndex;
use App\Http\Controllers\ThemeController;

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// تسجيل الدخول
Route::get('/login', Login::class)->name('login');

// توجيه بعد تسجيل الدخول حسب الدور
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isSuperAdmin()) {
        return redirect('/admin/dashboard');
    } elseif ($user->isAgencyAdmin() || $user->isAgencyUser()) {
        return redirect('/agency/dashboard');
    }

    return redirect('/');
})->middleware('auth')->name('dashboard');

// ==================== Admin Routes ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/agencies', AdminAgencies::class)->name('admin.agencies');
    Route::get('/agencies/add', AdminAddAgency::class)->name('admin.add-agency');
    Route::get('/agencies/edit/{id}', \App\Livewire\Admin\EditAgency::class)->name('admin.edit-agency');
    Route::get('/agencies/delete/{id}', \App\Livewire\Admin\DeleteAgency::class)->name('admin.delete-agency');
});

// ==================== إعداد العملة ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/setup-currency', [CurrencySetupController::class, 'form'])->name('agency.currency.setup');
    Route::post('/setup-currency', [CurrencySetupController::class, 'store'])->name('agency.currency.store');
});

// ==================== Agency Routes ====================
Route::middleware(['auth', 'agency'])->prefix('agency')->group(function () {

    // إعداد العملة للمرة الأولى (يجب أن يكون بدون middleware "money")
    Route::get('/setup-currency', SetupCurrency::class)->name('agency.setup-currency');

    // صفحة تغيير كلمة المرور (بدون تحقق من العملة أو كلمة المرور)
    Route::get('/change-password', ChangePassword::class)->name('agency.change-password');

    // باقي صفحات الوكالة (مع middleware التحقق من كلمة المرور ووجود العملة)
    Route::middleware(['mustChangePassword', 'ensureCurrency'])->group(function () {
        Route::get('/dashboard', AgencyDashboard::class)->name('agency.dashboard');
        Route::get('/users', AgencyUsers::class)->name('agency.users');
        Route::get('/roles', AgencyRoles::class)->name('agency.roles');
        Route::get('/permissions', AgencyPermissions::class)->name('agency.permissions');
        Route::get('/profile', AgencyProfile::class)->name('agency.profile');
        Route::get('/services', \App\Livewire\Agency\Services::class)->name('agency.services');
        Route::get('/sales', Index::class)->name('sales.index');
        Route::get('/sales/create', Create::class)->name('sales.create');
        Route::get('/customers/add', AddCustomer::class)->name('agency.customers.add');
        Route::get('/providers', \App\Livewire\Agency\Providers::class)->name('agency.providers');

        // تقرير المبيعات PDF
        Route::get('/sales/report/pdf', [\App\Http\Controllers\Agency\ReportController::class, 'salesPdf'])
            ->name('agency.sales.report.pdf');
    });
});

// ==================== تسجيل الخروج ====================
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

// ==================== إعادة تعيين كلمة المرور ====================
Route::get('/forgot-password', \App\Livewire\ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', \App\Livewire\ResetPassword::class)->name('password.reset');

// ==================== HR Routes ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/hr/employees/create', \App\Livewire\HR\EmployeeCreate::class)->name('hr.employees.create');
    Route::get('/hr/employees', EmployeeIndex::class)->name('hr.employees.index');
    Route::get('/hr/employees/{id}/edit', \App\Livewire\HR\EmployeeEdit::class)->name('hr.employees.edit');
});
Route::post('/update-theme', [ThemeController::class, 'updateTheme'])
    ->middleware(['auth', 'agency']);