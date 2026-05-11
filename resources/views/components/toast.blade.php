@props([
'statusCode' => null,
'errorCode' => null,
'message' => null
])

@if($message || $statusCode)
<div class="toast-wrapper">
    <section class="toast code-{{ $statusCode ?? 'default' }}">
        <div class="toast-content">
            @if($statusCode)
            <strong class="toast-title">
                {{ $statusCode }}
            </strong>
            @endif
            @if($message)
            <p class="toast-msg">
                {{ $message }}
            </p>
            @endif
        </div>
        <button class="toast-close">
            &times;
        </button>
    </section>
</div>
@endif