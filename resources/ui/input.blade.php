@props(['type' => 'text'])

<input type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'border rounded-lg px-3 py-2 w-full focus:ring-2 focus:ring-blue-400 shadow-sm'
    ]) }}>
