<?php

namespace App\Livewire\Agency;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Component
{
    public $search = '';
    public $showAddForm = false;
    public $editingUser = null;
    
    // Form fields
    public $name;
    public $email;
    public $password;
    public $role_id;
    public $is_active = true;
    public $user_type = 'agency_user';

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->editingUser)],
            'role_id' => 'nullable|exists:roles,id',
            'is_active' => 'boolean',
            'user_type' => 'required|in:agency_user,agency_admin',
        ];

        if (!$this->editingUser) {
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }

public function addUser()
{
    $this->validate();
    $agency = auth()->user()->agency;
    
    // التحقق من عدد المستخدمين النشطين فقط إذا كان المستخدم الجديد سيكون نشطاً
    if ($this->is_active) {
        $activeUsersCount = $agency->users()->where('is_active', true)->count();
        if ($activeUsersCount >= $agency->max_users) {
            session()->flash('error', 'لا يمكن تفعيل المزيد من المستخدمين. الحد الأقصى المسموح به لهذه الوكالة هو ' . $agency->max_users . ' مستخدم نشط.');
            return;
        }
    }
    
    User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password),
        'user_type' => $this->user_type,
        'agency_id' => $agency->id,
        'role_id' => $this->role_id,
        'is_active' => $this->is_active,
        'email_verified_at' => now(),
    ]);
    
    $this->resetForm();
    $this->showAddForm = false;
    session()->flash('message', 'تم إضافة المستخدم بنجاح');
}

public function toggleUserStatus($userId)
{
    $user = User::findOrFail($userId);
    $agency = auth()->user()->agency;
    
    // إذا كان المستخدم سيتحول إلى نشط، نتحقق من الحد الأقصى
    if (!$user->is_active) {
        $activeUsersCount = $agency->users()->where('is_active', true)->count();
        if ($activeUsersCount >= $agency->max_users) {
            session()->flash('error', 'لا يمكن تفعيل المزيد من المستخدمين. الحد الأقصى المسموح به لهذه الوكالة هو ' . $agency->max_users . ' مستخدم نشط.');
            return;
        }
    }
    
    $user->update(['is_active' => !$user->is_active]);
    session()->flash('message', 'تم تحديث حالة المستخدم بنجاح');
}

public function updateUser()
{
    $this->validate();
    
    $agency = auth()->user()->agency;
    
    // التحقق من عدد المستخدمين النشطين إذا كان التحديث سيجعل المستخدم نشطاً
    if ($this->is_active && !$this->editingUser->is_active) {
        $activeUsersCount = $agency->users()->where('is_active', true)->count();
        if ($activeUsersCount >= $agency->max_users) {
            session()->flash('error', 'لا يمكن تفعيل المزيد من المستخدمين. الحد الأقصى المسموح به لهذه الوكالة هو ' . $agency->max_users . ' مستخدم نشط.');
            return;
        }
    }
    
    $this->editingUser->update([
        'name' => $this->name,
        'email' => $this->email,
        'user_type' => $this->user_type,
        'role_id' => $this->role_id,
        'is_active' => $this->is_active,
    ]);

    if ($this->password) {
        $this->editingUser->update(['password' => Hash::make($this->password)]);
    }

    $this->resetForm();
    $this->showAddForm = false;
    session()->flash('message', 'تم تحديث المستخدم بنجاح');
}


    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        $this->is_active = $user->is_active;
        $this->user_type = $user->user_type;
        $this->showAddForm = true;
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        session()->flash('message', 'تم حذف المستخدم بنجاح');
    }

    public function resetForm()
    {
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role_id = '';
        $this->is_active = true;
        $this->user_type = 'agency_user';
    }

    public function render()
    {
        $agency = auth()->user()->agency;
        
        $users = User::where('agency_id', $agency->id)
            ->when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->with('role')
            ->latest()
            ->paginate(10);

        $roles = Role::where('agency_id', $agency->id)->get();

        return view('livewire.agency.users', compact('users', 'roles'))
            ->layout('layouts.agency');
    }
} 