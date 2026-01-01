@props(['autoDismiss' => 3000])

<div x-data="{ open: true }" 
     x-init="setTimeout(() => { open = false }, {{ $autoDismiss }})" 
     x-show="open" 
     x-transition.duration.400ms>
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-fg-success-strong rounded-base bg-success-soft" role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
    @elseif(session('deleted'))
        <div class="mb-4 p-4 text-sm text-fg-danger-strong rounded-lg bg-danger-soft" role="alert">
            <span class="font-medium">{{ session('deleted') }}</span>
        </div>
    @elseif(session('Edited'))
        <div class="p-4 mb-4 text-sm text-fg-success-strong rounded-base bg-success-soft" role="alert">
            <span class="font-medium">{{ session('Edited') }}</span>
        </div>
    @endif
</div>
