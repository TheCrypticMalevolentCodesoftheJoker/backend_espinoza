@props([
    'variant' => null,
    'code' => null,
    'message' => null
])

@php
$icons = [
    'success' => 'check-circle',
    'error'  => 'x-circle',
    'info'    => 'info',
];
@endphp

@if($message || $code)
<section class="toast {{ $variant }}" data-toast>
    <i data-lucide="{{ $icons[$variant] ?? 'info' }}"></i>
    <div>
        @if($code)
            <strong>[{{ $code }}]</strong>
        @endif
        @if($message)
            <h5>{{ $message }}</h5>
        @endif
    </div>
</section>
@endif