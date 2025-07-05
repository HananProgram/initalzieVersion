<?php

namespace App\Livewire\Accounting;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();
        
        // التحقق من أن المستخدم موظف حسابات
        if (!$user->isAccounting()) {
            return redirect('/')->with('error', 'ليس لديك صلاحية للوصول إلى هذه الصفحة.');
        }
        
        // التحقق من أن المستخدم نشط
        if (!$user->is_active) {
            return redirect('/')->with('error', 'تم تعطيل حسابك. يرجى التواصل مع الإدارة.');
        }
        
        // التحقق من أن المستخدم يجب أن يغير كلمة المرور
        if ($user->must_change_password) {
            return redirect()->route('accounting.change-password');
        }
        
        return view('livewire.accounting.dashboard')->layout('layouts.accounting');
    }
} 