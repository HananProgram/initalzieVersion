<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Agency;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AddAgency extends Component
{
    use WithFileUploads;

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
    public $logo;
    
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
            'logo' => 'nullable|image|max:2048', // 2MB Max
            'status' => 'required|in:active,inactive,suspended',

            'admin_name' => 'required|string|max:255',
            'admin_email' => ['required','email','unique:users,email'],
            'admin_password' => 'required|string|min:6',
        ];
    }

    public function save()
    {
        $this->validate();

        // تسجيل معلومات الصورة للتحقق
        Log::info('محاولة حفظ صورة', [
            'file_exists' => $this->logo ? $this->logo->exists() : false,
            'original_name' => $this->logo ? $this->logo->getClientOriginalName() : null,
            'temp_path' => $this->logo ? $this->logo->getRealPath() : null
        ]);

        DB::beginTransaction();
        try {
            // تخزين صورة الشعار إذا تم رفعها
            $logoPath = null;
            if ($this->logo) {
                $filename = uniqid().'.'.$this->logo->extension();
                $logoPath = 'agencies/logos/'.$filename;
                
                // طريقة بديلة أكثر موثوقية لحفظ الملف
                Storage::disk('public')->putFileAs(
                    'agencies/logos',
                    $this->logo,
                    $filename
                );

                // التحقق من وجود الملف بعد الحفظ
                if (!Storage::disk('public')->exists($logoPath)) {
                    throw new \Exception("فشل في حفظ الملف في المسار: ".$logoPath);
                }

                Log::info('تم حفظ الصورة بنجاح', ['path' => $logoPath]);
            }

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
                'status' => $this->status,
                'logo' => $logoPath,
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
                'currency', 'main_branch_name', 'admin_name', 'admin_email', 'admin_password', 'logo'
            ]);

            $this->successMessage = 'تمت إضافة الوكالة بنجاح مع تعيين أدمن خاص بها.';

        } catch (\Exception $e) {
            DB::rollBack();
            // حذف الصورة إذا فشلت العملية
            if (isset($logoPath) && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            Log::error('حدث خطأ أثناء إضافة الوكالة: '.$e->getMessage());
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