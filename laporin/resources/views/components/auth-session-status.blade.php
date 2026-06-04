@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-info']) }} style="margin-bottom:1rem">
        <i class="fa-solid fa-circle-info"></i>
        {{ $status }}
    </div>
@endif
