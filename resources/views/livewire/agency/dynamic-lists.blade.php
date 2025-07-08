<div class="space-y-6 p-4" wire:key="lists-container-{{ $lists->count() }}">
    @foreach ($lists as $list)
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow">
            <!-- اسم القائمة مع زر الفتح/الطي -->
            <button wire:click="toggleList({{ $list->id }})" class="w-full flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-800">{{ $list->name }}</h3>
                <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-500"
                    style="{{ in_array($list->id, $expandedLists) ? 'transform: rotate(180deg);' : '' }}"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            @if (in_array($list->id, $expandedLists))
                <div class="space-y-2">
                    @foreach ($list->items as $item)
                        <!-- زر البند الرئيسي -->
                        <div>
                            <button wire:click="toggleMainItem({{ $item->id }})"
                                class="w-full flex justify-between items-center bg-gray-100 hover:bg-gray-200 px-5 py-3 rounded-md border border-gray-300 text-right">
                                <span class="text-sm font-semibold text-gray-800">{{ $item->label }}</span>
                                <svg class="w-4 h-4 transform transition-transform duration-200"
                                    style="{{ in_array($item->id, $expandedMainItems) ? 'transform: rotate(180deg);' : '' }}"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>

                        <!-- البنود الفرعية -->
                        @if (in_array($item->id, $expandedMainItems))
                            <ul class="space-y-2 mt-3 px-2">
                                @foreach ($item->subItems as $sub)
                                    @if ($editingSubItemId === $sub->id)
                                        <!-- في حالة التعديل -->
                                        <li class="flex items-start gap-4 bg-white border rounded px-3 py-2">
                                            <input type="text" wire:model.defer="editingSubItemLabel"
                                                class="flex-1 text-sm border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">

                                            <div class="flex flex-wrap gap-2">
                                                <button wire:click="updateSubItem"
                                                    class="px-4 py-1.5 text-xs font-semibold rounded-md text-white bg-emerald-600 hover:bg-emerald-700 transition duration-200 shadow">
                                                    حفظ
                                                </button>

                                                <button wire:click="cancelEditSubItem"
                                                    class="px-4 py-1.5 text-xs font-semibold rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 transition duration-200 shadow">
                                                    إلغاء
                                                </button>

                                                @if ($sub->created_by === 'agency' && $sub->agency_id == auth()->user()->agency_id)
                                                    <button wire:click="deleteSubItem({{ $sub->id }})"
                                                        class="text-red-600 border border-red-500 hover:bg-red-50 px-3 py-1 rounded-md text-xs font-medium">
                                                        حذف
                                                    </button>
                                                @endif
                                            </div>
                                        </li>
                                    @else
                                        <!-- العرض العادي -->
                                        <li class="flex justify-between items-center bg-white border rounded px-3 py-2">
                                            <span class="text-sm text-gray-700">{{ $sub->label }}</span>
                                            <div class="flex gap-1">
                                                <button wire:click="startEditSubItem({{ $sub->id }})"
                                                    class="text-emerald-700 border border-emerald-600 hover:bg-emerald-50 px-3 py-1 rounded-md text-xs font-medium">
                                                    تعديل
                                                </button>
                                                @if ($sub->created_by === 'agency' && $sub->agency_id == auth()->user()->agency_id)
                                                    <button wire:click="deleteSubItem({{ $sub->id }})"
                                                        class="text-red-600 border border-red-500 hover:bg-red-50 px-3 py-1 rounded-md text-xs font-medium">
                                                        حذف
                                                    </button>
                                                @endif
                                            </div>
                                        </li>
                                    @endif
                                @endforeach

                                <!-- إضافة بند فرعي -->
                                @php
                                    $subKey = 'sub-' . $item->id . '-' . ($subItemLabel[$item->id] ?? uniqid());
                                @endphp

                                <li class="flex items-center gap-2 mt-3" wire:key="{{ $subKey }}">
                                    <input type="text" wire:model="subItemLabel.{{ $item->id }}"
                                        placeholder="اسم البند الفرعي"
                                        class="flex-1 text-sm border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">

                                    <button wire:click="addSubItem({{ $item->id }})" wire:loading.attr="disabled"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded text-xs font-medium border border-emerald-600 whitespace-nowrap">
                                        + إضافة
                                    </button>
                                </li>

                                @error("subItemLabel.$item->id")
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </ul>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
