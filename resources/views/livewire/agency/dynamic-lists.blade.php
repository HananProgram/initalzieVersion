<div class="space-y-6 p-4 bg-gray-50" wire:key="lists-container-{{ $lists->count() }}">
    @foreach ($lists as $list)
        <div class="bg-white rounded-xl shadow-md p-4">
            <!-- رأس القائمة -->
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <h3 class="text-lg font-bold text-emerald-700">{{ $list->name }}</h3>
                <button wire:click="toggleExpand({{ $list->id }})"
                    class="text-gray-500 hover:text-emerald-600 transition"
                    aria-label="{{ in_array($list->id, $expandedLists) ? 'طي القائمة' : 'توسيع القائمة' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform transition-transform duration-200"
                        :class="{ 'rotate-180': @js(in_array($list->id, $expandedLists)) }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            @if (in_array($list->id, $expandedLists))
                @foreach ($list->items as $item)
                    <div class="bg-gray-50 border rounded-lg p-3 mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-800 font-medium">{{ $item->label }}</span>
                        </div>

                        <ul class="space-y-2">
                            @foreach ($item->subItems as $sub)
                                <li class="flex justify-between items-center px-2">
                                    @if ($editingSubItemId === $sub->id)
                                        <form wire:submit.prevent="updateSubItem" class="flex items-center gap-2 w-full">
                                            <input type="text" wire:model.defer="editingSubItemLabel"
                                                class="flex-1 rounded-lg border border-gray-300 px-3 py-1 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                                            <button type="submit"
                                                class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-3 py-1 rounded-md text-xs font-medium transition">
                                                حفظ
                                            </button>
                                            <button type="button" wire:click="$set('editingSubItemId', null)"
                                                class="border border-gray-400 hover:bg-gray-100 px-3 py-1 rounded-md text-xs font-medium text-gray-600 transition">
                                                إلغاء
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-sm text-gray-600">{{ $sub->label }}</span>
                                        <div class="flex items-center gap-2">
                                            <button wire:click="startEditSubItem({{ $sub->id }})"
                                                class="text-emerald-700 border border-emerald-600 hover:bg-emerald-50 px-3 py-1 rounded-md text-xs font-medium transition">
                                                تعديل
                                            </button>
                                            @if (!$list->is_system)
                                                <button wire:click="deleteSubItem({{ $sub->id }})"
                                                    onclick="return confirm('هل أنت متأكد من الحذف؟')"
                                                    class="text-red-600 border border-red-500 hover:bg-red-50 px-3 py-1 rounded-md text-xs font-medium transition">
                                                    حذف
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <div class="flex items-center gap-2 mt-3">
                            <input type="text" wire:model.defer="subItemLabel.{{ $item->id }}"
                                placeholder="اسم البند الفرعي"
                                class="flex-1 rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none shadow-sm">
                            <button wire:click="addSubItem({{ $item->id }})" wire:loading.attr="disabled"
                                class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-4 py-1.5 rounded-md text-xs font-medium border border-emerald-600 whitespace-nowrap transition">
                                <span wire:loading.remove wire:target="addSubItem({{ $item->id }})">+ إضافة</span>
                                <span wire:loading wire:target="addSubItem({{ $item->id }})">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                        </div>

                        @error("subItemLabel.$item->id")
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</div>