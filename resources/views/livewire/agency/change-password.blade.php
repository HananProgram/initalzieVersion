<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow">
    <h2 class="text-xl font-bold text-center mb-4">تغيير كلمة المرور</h2>

    @if (session()->has('success'))
        <div class="text-green-600 text-center font-semibold mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updatePassword" class="space-y-4">
        <div>
            <label class="block mb-1">كلمة المرور الجديدة</label>
            <input type="password" wire:model.defer="password"
                   class="w-full border rounded px-3 py-2">
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1">تأكيد كلمة المرور</label>
            <input type="password" wire:model.defer="password_confirmation"
                   class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit"
                class="w-full bg-emerald-600 text-white font-bold py-2 rounded hover:bg-emerald-700 transition">
            تحديث كلمة المرور
        </button>
    </form>
</div>
