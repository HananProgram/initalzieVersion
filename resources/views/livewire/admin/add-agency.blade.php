<div>
<div class="flex flex-col h-screen overflow-hidden">
    <!-- القسم العلوي الثابت -->
    <div class="flex-none p-4 bg-gray-50">
        <!-- نموذج إضافة الوكالة -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <h2 class="text-xl font-bold text-emerald-700 mb-4 text-center">إضافة وكالة جديدة وتعيين أدمن للوكالة</h2>

            @if($successMessage)
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                    {{ $successMessage }}
                </div>
            @endif
            @error('general')
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg text-center">
                    {{ $message }}
                </div>
            @enderror

            <form wire:submit.prevent="save" class="space-y-4 text-sm" id="mainForm">
                @php
                    $fieldClass = 'w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer';
                    $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600';
                    $containerClass = 'relative mt-1';
                @endphp

                <!-- الصف الأول -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="name" class="{{ $fieldClass }}" placeholder="اسم الوكالة" />
                        <label class="{{ $labelClass }}">اسم الوكالة</label>
                        @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="main_branch_name" class="{{ $fieldClass }}" placeholder="اسم الفرع الرئيسي" />
                        <label class="{{ $labelClass }}">اسم الفرع الرئيسي</label>
                        @error('main_branch_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="email" wire:model.defer="email" class="{{ $fieldClass }}" placeholder="البريد الإلكتروني للوكالة" />
                        <label class="{{ $labelClass }}">البريد الإلكتروني</label>
                        @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الثاني -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="phone" class="{{ $fieldClass }}" placeholder="رقم الهاتف" />
                        <label class="{{ $labelClass }}">رقم الهاتف</label>
                        @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="landline" class="{{ $fieldClass }}" placeholder="الهاتف الثابت" />
                        <label class="{{ $labelClass }}">الهاتف الثابت</label>
                        @error('landline') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model.defer="currency" class="{{ $fieldClass }}">
                            <option value="">اختر العملة</option>
                            <option value="SAR">ريال سعودي (SAR)</option>
                            <option value="USD">دولار أمريكي (USD)</option>
                            <option value="EUR">يورو (EUR)</option>
                        </select>
                        <label class="{{ $labelClass }}">العملة</label>
                        @error('currency') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الثالث -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="agency_address" class="{{ $fieldClass }}" placeholder="العنوان" />
                        <label class="{{ $labelClass }}">العنوان</label>
                        @error('agency_address') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="license_number" class="{{ $fieldClass }}" placeholder="رقم الرخصة" />
                        <label class="{{ $labelClass }}">رقم الرخصة</label>
                        @error('license_number') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="commercial_record" class="{{ $fieldClass }}" placeholder="السجل التجاري" />
                        <label class="{{ $labelClass }}">السجل التجاري</label>
                        @error('commercial_record') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الرابع -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model.defer="tax_number" class="{{ $fieldClass }}" placeholder="الرقم الضريبي" />
                        <label class="{{ $labelClass }}">الرقم الضريبي</label>
                        @error('tax_number') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="date" wire:model.defer="license_expiry_date" class="{{ $fieldClass }}" placeholder="تاريخ انتهاء الرخصة" />
                        <label class="{{ $labelClass }}">انتهاء الرخصة</label>
                        @error('license_expiry_date') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model.defer="status" class="{{ $fieldClass }}">
                            <option value="active">نشطة</option>
                            <option value="inactive">غير نشطة</option>
                            <option value="suspended">موقوفة</option>
                        </select>
                        <label class="{{ $labelClass }}">حالة الوكالة</label>
                        @error('status') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الخامس -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="file" wire:model="logo" class="{{ $fieldClass }}" placeholder="شعار الوكالة" />
                        <label class="{{ $labelClass }}">شعار الوكالة</label>
                        @error('logo') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }} md:col-span-2">
                        <textarea wire:model.defer="description" rows="2" class="{{ $fieldClass }}" placeholder="وصف الوكالة (اختياري)"></textarea>
                        <label class="{{ $labelClass }}">وصف الوكالة</label>
                        @error('description') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- الصف السادس - تواريخ الاشتراك -->
                <div class="grid md:grid-cols-3 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="date" wire:model.defer="subscription_start_date" class="{{ $fieldClass }}" placeholder="تاريخ بداية الاشتراك" />
                        <label class="{{ $labelClass }}">بداية الاشتراك</label>
                        @error('subscription_start_date') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="date" wire:model.defer="subscription_end_date" class="{{ $fieldClass }}" placeholder="تاريخ نهاية الاشتراك" />
                        <label class="{{ $labelClass }}">نهاية الاشتراك</label>
                        @error('subscription_end_date') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- قسم بيانات الأدمن -->
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <h3 class="text-lg font-bold text-emerald-700 mb-4 text-center">بيانات أدمن الوكالة</h3>
                    
                    <div class="grid md:grid-cols-3 gap-3">
                        <div class="{{ $containerClass }}">
                            <input type="text" wire:model.defer="admin_name" class="{{ $fieldClass }}" placeholder="اسم الأدمن" />
                            <label class="{{ $labelClass }}">اسم الأدمن</label>
                            @error('admin_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="{{ $containerClass }}">
                            <input type="email" wire:model.defer="admin_email" class="{{ $fieldClass }}" placeholder="البريد الإلكتروني للأدمن" />
                            <label class="{{ $labelClass }}">بريد الأدمن</label>
                            @error('admin_email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="{{ $containerClass }}">
                            <input type="password" wire:model.defer="admin_password" class="{{ $fieldClass }}" placeholder="كلمة المرور للأدمن" />
                            <label class="{{ $labelClass }}">كلمة المرور</label>
                            @error('admin_password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- أزرار الحفظ -->
                <div class="mt-8 flex justify-center">
                    <button type="submit" 
                        class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                            text-white font-bold px-8 py-3 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
                        حفظ الوكالة
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- القسم السفلي (يمكن إضافة جدول للوكالات إذا لزم الأمر) -->
    <div class="flex-1 overflow-hidden px-4 pb-4">
        <!-- يمكنك إضافة محتوى إضافي هنا مثل قائمة الوكالات -->
    </div>
</div>

<style>
    html, body {
        height: 100%;
        overflow: hidden;
    }

    .peer:placeholder-shown + label {
        top: 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .peer:not(:placeholder-shown) + label,
    .peer:focus + label {
        top: -0.5rem;
        font-size: 0.75rem;
        color: #059669;
    }
    
    select:required:invalid {
        color: #6b7280;
    }
    
    select option {
        color: #111827;
    }

    @media (max-width: 768px) {
        .flex-col.md\:flex-row > .md\:w-1\/2 {
            width: 100% !important;
        }
    }
</style>
</div>