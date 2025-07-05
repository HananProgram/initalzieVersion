<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Agency;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AddAgency extends Component
{
    // بيانات الوكالة
    public $name;
    public $email;
    public $phone;
    public $landline;
    public $address;
    public $license_number;
    public $commercial_record;
    public $tax_number;
    public $license_expiry_date;
    public $description;
    public $currency;
    public $main_branch_name;
    public $status = 'active';
    // بيانات أدمن الوكالة
    public $admin_name;
    public $admin_email;
    public $admin_password;

    public $successMessage;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agencies,email',
            'phone' => 'required|string|max:30',
            'landline' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'license_number' => 'required|string|unique:agencies,license_number',
            'commercial_record' => 'required|string|unique:agencies,commercial_record',
            'tax_number' => 'required|string|unique:agencies,tax_number',
            'license_expiry_date' => 'required|date',
            'description' => 'nullable|string',
            'currency' => 'required|string|max:10',
            'main_branch_name' => 'required|string|max:255',

            'admin_name' => 'required|string|max:255',
            'admin_email' => ['required','email','unique:users,email'],
            'admin_password' => 'required|string|min:6',
        ];
    }

    public function save()
    {
        $this->validate();

        DB::beginTransaction();
        try {
                $agency = Agency::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'landline' => $this->landline,
                    'address' => $this->address,
                    'license_number' => $this->license_number,
                    'commercial_record' => $this->commercial_record,
                    'tax_number' => $this->tax_number,
                    'license_expiry_date' => $this->license_expiry_date,
                    'description' => $this->description,
                    'currency' => $this->currency,
                    'main_branch_name' => $this->main_branch_name,
                    'status' => $this->status, // تأكد من وجود هذا الحقل
                    'logo' => null,
                ]);

            $role = Role::where('name', 'agency_admin')->first();

            User::create([
                'name' => $this->admin_name,
                'email' => $this->admin_email,
                'password' => Hash::make($this->admin_password),
                'user_type' => 'agency_admin',
                'agency_id' => $agency->id,
                'role_id' => $role?->id,
                'is_active' => true,
                'email_verified_at' => now(),
            ]);

            DB::commit();

            $this->reset([
                'name', 'email', 'phone', 'landline', 'address', 'license_number',
                'commercial_record', 'tax_number', 'license_expiry_date', 'description',
                'currency', 'main_branch_name', 'admin_name', 'admin_email', 'admin_password'
            ]);

            $this->successMessage = 'تمت إضافة الوكالة بنجاح مع تعيين أدمن خاص بها.';
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'حدث خطأ أثناء إضافة الوكالة: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.add-agency')
            ->layout('layouts.admin')
            ->title('إضافة وكالة جديدة - نظام إدارة وكالات السفر');
    }
}
