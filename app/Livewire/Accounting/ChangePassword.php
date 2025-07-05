<?php

namespace App\Livewire\Accounting;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    public $password, $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->must_change_password = false;
        $user->save();

        session()->flash('success', 'تم تغيير كلمة المرور بنجاح.');

        return redirect()->route('accounting.dashboard');
    }

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
        if (!$user->must_change_password) {
            return redirect()->route('accounting.dashboard');
        }
        
        return view('livewire.accounting.change-password')->layout('layouts.accounting');
    }
} 