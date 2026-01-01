@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
])

<div class="mb-5">
    <label for="{{ $name }}" class="block mb-2.5 text-xl font-medium text-heading">
        {{ $label }}
    </label>
    <input 
        type="{{ $type }}" 
        id="{{ $name }}"
        wire:model="{{ $name }}"
        @class([
            'border text-sm rounded-base block w-full px-3 py-2.5 shadow-xs',
            'bg-danger-soft border-danger-subtle text-fg-danger-strong focus:ring-danger focus:border-danger placeholder:text-fg-danger-strong' => $errors->has($name),
            'bg-neutral-secondary-medium border-default-medium text-heading focus:ring-brand focus:border-brand placeholder:text-body' => !$errors->has($name),
        ])
        placeholder="{{ $placeholder }}"
        {{ $attributes }}
    />
    @error($name)
        <p class="mt-2.5 text-sm text-fg-danger-strong">
            <span class="font-medium">{{ $message }}</span>
        </p>
    @enderror
</div>
