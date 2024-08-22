<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-1">
    @php
        $tags = explode(',', $getState());
        $newTags = [];
        $colors = ['success', 'danger', 'info', 'warning'];
        foreach ($tags as $key => $value) {
            $newTags[$key] = $value;
        }
    @endphp
    @foreach ($newTags as $tag)
        @php
            $color = $colors[array_rand($colors)];
        @endphp
        <x-filament::badge size="sm" color="{{ $color }}">
            {{ $tag }}
        </x-filament::badge>
    @endforeach
</div>
