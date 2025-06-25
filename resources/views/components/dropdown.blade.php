<div {{ $attributes->merge(['class' => 'relative']) }}>
    <div {{ $trigger->attributes }}>
        {{ $trigger }}
    </div>

    <div {{ $content->attributes->merge(['class' => 'absolute z-50 mt-2 rounded-md shadow-lg', 'style' => 'display: none;']) }} x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="display: none;" @click.away="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white dark:bg-gray-700">
            {{ $content }}
        </div>
    </div>
</div> 