@props(['color' => 'blue'])

<button 
    {{ $attributes->merge([
        'class' => "px-4 py-2 rounded-lg text-white bg-$color-600 hover:bg-$color-700 shadow transition"
    ]) }}>
    {{ $slot }}
</button>
