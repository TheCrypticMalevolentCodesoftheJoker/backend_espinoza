@props(['type' => 'button', 'variant' => null])

<button class="strokeButton {{ $variant }}" type="{{ $type }}">
    @if(trim($slot))
        {{ $slot }}
    @endif
</button>
