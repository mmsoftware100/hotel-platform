{{-- bug ရှိ သုံးမရသေး/ sample code အဖြစ်သာ --}}

<div class="grid grid-cols-4 gap-4">
    @foreach ($getOptions() as $value => $url)
        <label class="cursor-pointer">
            <input 
                type="radio" 
                wire:model="{{ $getStatePath() }}" 
                value="{{ $value }}" 
                class="hidden peer"
            />

            <div class="rounded-xl border-2 border-gray-300 peer-checked:border-primary-500 overflow-hidden shadow">
                <img src="{{ $url }}" class="h-32 w-full object-cover" />
                <div class="p-2 text-center text-sm">
                    {{ basename($value) }}
                </div>
            </div>
        </label>
    @endforeach
</div>
