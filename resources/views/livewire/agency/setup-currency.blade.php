<div class="max-w-md mx-auto mt-20 p-6 bg-white shadow-md rounded-xl">
    <h2 class="text-xl font-bold mb-4 text-center">اختر العملة الأساسية لوكالتك</h2>

    <form wire:submit.prevent="save">
        <select wire:model="currency" class="w-full p-2 border rounded">
            <option value="">-- اختر العملة --</option>
            @foreach ($currencies as $curr)
                <option value="{{ $curr }}">{{ $curr }}</option>
            @endforeach
        </select>

        @error('currency')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror

        <button type="submit" class="mt-4 bg-emerald-600 text-white px-4 py-2 rounded w-full">
            حفظ العملة
        </button>
    </form>
</div>
