<div>
<div class="flex flex-col h-screen overflow-hidden">
    <!-- القسم العلوي الثابت -->
    <div class="flex-none p-4 bg-gray-50">
        <!-- نموذج الإضافة المدمج -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <h2 class="text-xl font-bold text-emerald-700 mb-4 text-center">إضافة عملية بيع</h2>

            <form wire:submit.prevent="save" class="space-y-4 text-sm" id="mainForm">
                @php
                    $fieldClass = 'w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none bg-white text-xs peer';
                    $labelClass = 'absolute right-3 -top-2.5 px-1 bg-white text-xs text-gray-500 transition-all peer-focus:-top-2.5 peer-focus:text-xs peer-focus:text-emerald-600';
                    $containerClass = 'relative mt-1';
                @endphp

                <!-- الصف الأول -->
                <div class="grid md:grid-cols-4 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="beneficiary_name" class="{{ $fieldClass }}" placeholder="اسم المستفيد" />
                        <label class="{{ $labelClass }}">اسم المستفيد</label>
                        @error('beneficiary_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="date" wire:model="sale_date" class="{{ $fieldClass }}" placeholder="تاريخ البيع" />
                        <label class="{{ $labelClass }}">تاريخ البيع</label>
                        @error('sale_date') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model="service_type_id" class="{{ $fieldClass }}">
                            <option value="">نوع الخدمة</option>
                            @foreach($serviceTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <label class="{{ $labelClass }}">نوع الخدمة</label>
                        @error('service_type_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model="provider_id" class="{{ $fieldClass }}">
                            <option value="">المزود</option>
                            @foreach($providers as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                        <label class="{{ $labelClass }}">المزود</label>
                        @error('provider_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الثاني -->
                <div class="grid md:grid-cols-4 gap-3">
                    <div class="{{ $containerClass }}">
                        <select wire:model="intermediary_id" class="{{ $fieldClass }}">
                            <option value="">الوسيط</option>
                            @foreach($intermediaries as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                            @endforeach
                        </select>
                        <label class="{{ $labelClass }}">الوسيط</label>
                        @error('intermediary_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model="customer_id" class="{{ $fieldClass }}">
                            <option value="">العميل</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <label class="{{ $labelClass }}">العميل</label>
                        @error('customer_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <select wire:model="account_id" class="{{ $fieldClass }}">
                            <option value="">الحساب</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                        <label class="{{ $labelClass }}">الحساب</label>
                        @error('account_id') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="action" class="{{ $fieldClass }}" placeholder="الإجراء" />
                        <label class="{{ $labelClass }}">الإجراء</label>
                        @error('action') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الثالث -->
                <div class="grid md:grid-cols-4 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="number" wire:model="usd_buy" step="0.01" class="{{ $fieldClass }}" placeholder="USD Buy" />
                        <label class="{{ $labelClass }}">USD Buy</label>
                        @error('usd_buy') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="number" wire:model="usd_sell" step="0.01" class="{{ $fieldClass }}" placeholder="USD Sell" />
                        <label class="{{ $labelClass }}">USD Sell</label>
                        @error('usd_sell') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="number" wire:model="sale_profit" step="0.01" class="{{ $fieldClass }}" placeholder="الربح" />
                        <label class="{{ $labelClass }}">الربح</label>
                        @error('sale_profit') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="number" wire:model="amount_received" class="{{ $fieldClass }}" step="0.01" placeholder="المبلغ المدفوع" />
                        <label class="{{ $labelClass }}">المبلغ المدفوع</label>
                        @error('amount_received') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- الصف الرابع -->
                <div class="grid md:grid-cols-4 gap-3">
                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="reference" class="{{ $fieldClass }}" placeholder="المرجع" />
                        <label class="{{ $labelClass }}">المرجع</label>
                        @error('reference') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="pnr" class="{{ $fieldClass }}" placeholder="PNR" />
                        <label class="{{ $labelClass }}">PNR</label>
                        @error('pnr') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="route" class="{{ $fieldClass }}" placeholder="Route" />
                        <label class="{{ $labelClass }}">Route</label>
                        @error('route') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="{{ $containerClass }}">
                        <input type="text" wire:model="depositor_name" class="{{ $fieldClass }}" placeholder="اسم المودع" />
                        <label class="{{ $labelClass }}">اسم المودع</label>
                        @error('depositor_name') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- صف الملاحظات والأزرار -->
                <div class="flex flex-col md:flex-row gap-4 pt-4">
                    <!-- حقل الملاحظات (50% من العرض) -->
                    <div class="{{ $containerClass }} md:w-1/2">
                        <textarea wire:model="note" rows="2" class="{{ $fieldClass }}" placeholder="ملاحظات"></textarea>
                        <label class="{{ $labelClass }}">ملاحظات</label>
                        @error('note') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- الأزرار (50% من العرض) -->
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 md:w-1/2 items-center justify-center">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm w-full">
                            حفظ العملية
                        </button>

                        <button type="button" onclick="openFieldsModal()"
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm w-full">
                            تقرير مخصص
                        </button>

                        <a href="{{ route('agency.sales.report.pdf') }}?start_date={{ request('start_date') }}&end_date={{ request('end_date') }}"
                            target="_blank"
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold px-4 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm w-full">
                            تقرير كامل
                        </a>

                        <button type="button" wire:click="resetFields"
                            class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold px-4 py-2 rounded-xl shadow transition duration-300 text-sm w-full">
                            تنظيف الحقول
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- نافذة اختيار الحقول -->
        <div id="fieldsModal" class="fixed inset-0 bg-black/10 flex items-center justify-center hidden z-50 backdrop-blur-sm transition-all duration-300">
            <div class="bg-white rounded-xl shadow-xl p-6 w-full max-w-md transform transition-all duration-300 scale-95 opacity-0"
                id="modalContent">
                <h3 class="text-xl font-bold text-emerald-700 mb-4 text-center">اختر حقول التقرير</h3>
                
                <form id="customReportForm" action="{{ route('agency.sales.report.pdf') }}" method="GET" target="_blank" onsubmit="prepareCustomReport()">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    
                    <div class="grid grid-cols-2 gap-4 max-h-96 overflow-y-auto p-2">
                        @foreach([
                            'sale_date' => 'التاريخ',
                            'beneficiary_name' => 'المستفيد',
                            'customer' => 'العميل',
                            'serviceType' => 'الخدمة',
                            'provider' => 'المزود',
                            'intermediary' => 'الوسيط',
                            'usd_buy' => 'USD Buy',
                            'usd_sell' => 'USD Sell',
                            'sale_profit' => 'الربح',
                            'amount_received' => 'المبلغ',
                            'account' => 'الحساب',
                            'reference' => 'المرجع',
                            'pnr' => 'PNR',
                            'route' => 'Route'
                        ] as $field => $label)
                        <div class="flex items-center">
                            <label class="flex items-center space-x-2 space-x-reverse cursor-pointer">
                                <input type="checkbox"
       name="fields[]"
       value="{{ $field }}"
       checked
       class="h-4 w-4 rounded border-gray-300 focus:ring-emerald-500 text-emerald-600 accent-emerald-600" />

                                <span class="text-gray-700 text-sm">{{ $label }}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 flex justify-center gap-3">
                        <button type="button" onclick="closeFieldsModal()"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-6 py-2 rounded-xl shadow transition 
                                duration-300 text-sm">
                            إلغاء
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 
                                text-white font-bold px-6 py-2 rounded-xl shadow-md hover:shadow-xl transition duration-300 text-sm">
                            تحميل التقرير
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- القسم السفلي مع الجدول القابل للتمرير -->
    <div class="flex-1 overflow-hidden px-4 pb-4">
            <div class="bg-white rounded-xl shadow-md h-full flex flex-col">
            <div class="overflow-y-auto flex-1">
                <table class="min-w-full divide-y divide-gray-200 text-xs text-right">
                    <thead class="bg-gray-100 text-gray-600 sticky top-0 z-10">
                        <tr>
                            <th class="px-2 py-1">التاريخ</th>
                            <th class="px-2 py-1">المستفيد</th>
                            <th class="px-2 py-1">العميل</th>
                            <th class="px-2 py-1">الخدمة</th>
                            <th class="px-2 py-1">المزود</th>
                            <th class="px-2 py-1">الوسيط</th>
                            <th class="px-2 py-1">Buy</th>
                            <th class="px-2 py-1">Sell</th>
                            <th class="px-2 py-1">الربح</th>
                            <th class="px-2 py-1">المبلغ</th>
                            <th class="px-2 py-1">الحساب</th>
                            <th class="px-2 py-1">المرجع</th>
                            <th class="px-2 py-1">PNR</th>
                            <th class="px-2 py-1">Route</th>
                            <th class="px-2 py-1">الإجراء</th>
                            <th class="px-2 py-1">الموظف</th>
                            <th class="px-2 py-1">خيارات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($sales as $sale)
                            <tr class="hover:bg-gray-50">
                                <td class="px-2 py-1 whitespace-nowrap">{{ $sale->sale_date }}</td>
                                <td class="px-2 py-1">{{ $sale->beneficiary_name }}</td>
                                <td class="px-2 py-1">{{ $sale->customer->name ?? '-' }}</td>
                                <td class="px-2 py-1">{{ $sale->serviceType->name ?? '-' }}</td>
                                <td class="px-2 py-1">{{ $sale->provider->name ?? '-' }}</td>
                                <td class="px-2 py-1">{{ $sale->intermediary->name ?? '-' }}</td>
                                <td class="px-2 py-1 text-green-700 font-semibold">{{ number_format($sale->usd_buy, 2) }}</td>
                                <td class="px-2 py-1 text-red-700 font-semibold">{{ number_format($sale->usd_sell, 2) }}</td>
                                <td class="px-2 py-1 text-blue-700 font-semibold">{{ number_format($sale->sale_profit, 2) }}</td>
                                <td class="px-2 py-1">{{ number_format($sale->amount_received, 2) }}</td>
                                <td class="px-2 py-1">{{ $sale->account->name ?? '-' }}</td>
                                <td class="px-2 py-1">{{ $sale->reference }}</td>
                                <td class="px-2 py-1">{{ $sale->pnr }}</td>
                                <td class="px-2 py-1">{{ $sale->route }}</td>
                                <td class="px-2 py-1">{{ $sale->action }}</td>
                                <td class="px-2 py-1">{{ $sale->user->name ?? '-' }}</td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <button wire:click="duplicate({{ $sale->id }})"
                                        class="text-emerald-600 hover:text-emerald-800 font-medium text-xs mx-1">تكرار</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="17" class="text-center py-4 text-gray-400">لا توجد عمليات بيع</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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

<script>
function openFieldsModal() {
    const modal = document.getElementById('fieldsModal');
    const content = document.getElementById('modalContent');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('bg-opacity-0');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeFieldsModal() {
    const modal = document.getElementById('fieldsModal');
    const content = document.getElementById('modalContent');
    
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function prepareCustomReport() {
    event.preventDefault();
    document.getElementById('mainForm').style.display = 'none';
    
    setTimeout(() => {
        document.getElementById('customReportForm').submit();
        document.getElementById('mainForm').style.display = 'block';
        closeFieldsModal();
    }, 100);
}
</script>
</div>