<div class="space-y-6">
    <!-- العنوان والزر الرجوع -->
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold text-emerald-700 border-b-2 border-emerald-200 pb-2">إضافة موظف جديد</h2>
        <a href="{{ route('hr.employees.index') }}"
           class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                  text-white font-bold py-2 px-4 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
            ← العودة للقائمة
        </a>
    </div>

    <!-- نموذج الإضافة -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            @php
                $fieldClass = 'w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-sm peer';
                $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-sm text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-emerald-600';
                $containerClass = 'relative mt-1';
            @endphp

            <!-- الصف الأول -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- الاسم -->
                <div class="{{ $containerClass }}">
                    <input type="text" wire:model.defer="name" class="{{ $fieldClass }}" placeholder="الاسم" />
                    <label class="{{ $labelClass }}">الاسم</label>
                    @error('name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div class="{{ $containerClass }}">
                    <input type="email" wire:model.defer="email" class="{{ $fieldClass }}" placeholder="البريد الإلكتروني" />
                    <label class="{{ $labelClass }}">البريد الإلكتروني</label>
                    @error('email') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- الصف الثاني -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- كلمة المرور -->
                <div class="{{ $containerClass }}">
                    <input type="password" wire:model.defer="password" class="{{ $fieldClass }}" placeholder="كلمة المرور" />
                    <label class="{{ $labelClass }}">كلمة المرور</label>
                    @error('password') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div class="{{ $containerClass }}">
                    <input type="password" wire:model.defer="password_confirmation" class="{{ $fieldClass }}" placeholder="تأكيد كلمة المرور" />
                    <label class="{{ $labelClass }}">تأكيد كلمة المرور</label>
                </div>
            </div>

            <!-- الصف الثالث -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- القسم -->
                <div class="{{ $containerClass }}">
                    <select wire:model="department_id" class="{{ $fieldClass }}">
                        <option value="">اختر القسم</option>
                        @foreach($departments as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <label class="{{ $labelClass }}">القسم</label>
                    @error('department_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الوظيفة -->
                <div class="{{ $containerClass }}">
                    <select wire:model="position_id" class="{{ $fieldClass }}">
                        <option value="">اختر الوظيفة</option>
                        @foreach($positions as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <label class="{{ $labelClass }}">الوظيفة</label>
                    @error('position_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- الصف الرابع -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- رقم الهاتف -->
                <div class="{{ $containerClass }}">
                    <input type="text" wire:model.defer="phone" class="{{ $fieldClass }}" placeholder="رقم الهاتف" />
                    <label class="{{ $labelClass }}">رقم الهاتف</label>
                    @error('phone') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- الفرع -->
                <div class="{{ $containerClass }}">
                    <input type="text" wire:model.defer="branch" class="{{ $fieldClass }}" placeholder="الفرع" />
                    <label class="{{ $labelClass }}">الفرع</label>
                    @error('branch') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- اسم المستخدم -->
            <div class="{{ $containerClass }}">
                <input type="text" wire:model.defer="user_name" class="{{ $fieldClass }}" placeholder="اسم المستخدم" />
                <label class="{{ $labelClass }}">اسم المستخدم</label>
                @error('user_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
            </div>
            <!-- زر الحفظ -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                              text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-base">
                    حفظ الموظف
                </button>
            </div>
        </form>
    </div>

    <style>
        .peer:placeholder-shown + label {
            top: 1rem;
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
    </style>
</div>
