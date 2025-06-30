<?php

namespace App\Livewire\Agency;

use Livewire\Component;
use App\Models\Role;

class Roles extends Component
{
    public $search = '';
    public $showAddForm = false;
    public $editingRole = null;
    
    // Form fields
    public $name;
    public $display_name;
    public $description;
    public $permissions = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'permissions' => 'array',
        ];
    }

    public function addRole()
    {
        $this->validate();
        
        $agency = auth()->user()->agency;
        
        Role::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'agency_id' => $agency->id,
            'permissions' => $this->permissions,
        ]);

        $this->resetForm();
        $this->showAddForm = false;
        session()->flash('message', 'تم إضافة الدور بنجاح');
    }

    public function editRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->editingRole = $role;
        $this->name = $role->name;
        $this->display_name = $role->display_name;
        $this->description = $role->description;
        
        // Handle permissions data safely
        $permissions = $role->permissions;
        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true) ?? [];
        } elseif (!is_array($permissions)) {
            $permissions = [];
        }
        
        $this->permissions = $permissions;
        $this->showAddForm = true;
    }

    public function updateRole()
    {
        $this->validate();
        
        $this->editingRole->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'permissions' => $this->permissions,
        ]);

        $this->resetForm();
        $this->showAddForm = false;
        session()->flash('message', 'تم تحديث الدور بنجاح');
    }

    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        session()->flash('message', 'تم حذف الدور بنجاح');
    }

    public function resetForm()
    {
        $this->editingRole = null;
        $this->name = '';
        $this->display_name = '';
        $this->description = '';
        $this->permissions = [];
    }

    public function render()
    {
        $agency = auth()->user()->agency;
        
        $roles = Role::where('agency_id', $agency->id)
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('users')
            ->latest()
            ->paginate(10);

        $availablePermissions = [
            'users.view' => 'عرض المستخدمين',
            'users.create' => 'إضافة مستخدمين',
            'users.edit' => 'تعديل المستخدمين',
            'users.delete' => 'حذف المستخدمين',
            'roles.view' => 'عرض الأدوار',
            'roles.create' => 'إضافة أدوار',
            'roles.edit' => 'تعديل الأدوار',
            'roles.delete' => 'حذف الأدوار',
            'permissions.view' => 'عرض الصلاحيات',
            'permissions.manage' => 'إدارة الصلاحيات',
            'services.view' => 'عرض الخدمات',
            'services.create' => 'إضافة خدمة',
            'services.edit' => 'تعديل خدمة',
            'services.delete' => 'حذف خدمة',
        ];

        return view('livewire.agency.roles', compact('roles', 'availablePermissions'))
            ->layout('layouts.agency');
    }
} 