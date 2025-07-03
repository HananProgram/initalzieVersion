<div class="space-y-6">
    <!-- رسالة النجاح -->
    @if (session()->has('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 2000)"
             x-show="show"
             x-transition
             class="w-fit ml-auto bg-emerald-100 text-emerald-700 rounded-md px-4 py-2 text-center shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- العنوان وزر الإضافة -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-emerald-700 border-b-2 border-emerald-200 pb-2">قائمة الموظفين</h2>
        <a href="{{ route('hr.employees.create') }}"
           class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                  text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
            + إضافة موظف
        </a>
    </div>

    <!-- البحث والفلاتر -->
    <div class="grid md:grid-cols-4 gap-3">
        <div class="relative mt-1">
            <input type="text" 
                   wire:model.live="search"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer"
                   placeholder="ابحث بالاسم أو البريد">
            <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">
                بحث
            </label>
        </div>

        <div class="relative mt-1">
            <select wire:model.lazy="department_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer">
                <option value="">كل الأقسام</option>
                @foreach($departments as $id => $name)
                    <option wire:key="dep-{{ $id }}" value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">
                القسم
            </label>
        </div>

        <div class="relative mt-1">
            <select wire:model.lazy="position_id"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer">
                <option value="">كل الوظائف</option>
                @foreach($positions as $id => $name)
                    <option wire:key="pos-{{ $id }}" value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <label class="absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600">
                الوظيفة
            </label>
        </div>

        <div class="flex items-center text-xs text-gray-600">
            عدد الموظفين: {{ $employees->total() }}
        </div>
    </div>

    <!-- جدول الموظفين -->
    <!-- جدول الموظفين -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-2 py-1">#</th>
                    <th class="px-2 py-1">الاسم</th>
                    <th class="px-2 py-1">اسم المستخدم</th>
                    <th class="px-2 py-1">البريد الإلكتروني</th>
                    <th class="px-2 py-1">الهاتف</th>
                    <th class="px-2 py-1">الفرع</th>
                    <th class="px-2 py-1">القسم</th>
                    <th class="px-2 py-1">الوظيفة</th>
                    <th class="px-2 py-1">تاريخ الإنشاء</th>
                    <th class="px-2 py-1">إجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-1 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-2 py-1">{{ $employee->name }}</td>
                        <td class="px-2 py-1">{{ $employee->user_name ?? '—' }}</td>
                        <td class="px-2 py-1">{{ $employee->email }}</td>
                        <td class="px-2 py-1">{{ $employee->phone ?? '—' }}</td>
                        <td class="px-2 py-1">{{ $employee->branch ?? '—' }}</td>
                        <td class="px-2 py-1">{{ $employee->department?->name ?? '—' }}</td>
                        <td class="px-2 py-1">{{ $employee->position?->name ?? '—' }}</td>
                        <td class="px-2 py-1 whitespace-nowrap">{{ $employee->created_at->format('Y-m-d') }}</td>
                        <td class="px-2 py-1 whitespace-nowrap">
                            <a href="{{ route('hr.employees.edit', $employee->id) }}"
                               class="text-emerald-600 hover:text-emerald-800 font-medium text-xs mx-1">
                                تعديل
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center py-4 text-gray-400">
                            لا توجد نتائج مطابقة لبحثك.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($employees->hasPages())
        <div class="px-4 py-2 border-t border-gray-200">
            {{ $employees->links() }}
        </div>
    @endif
</div>


    <style>
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
    </style>
</div>
