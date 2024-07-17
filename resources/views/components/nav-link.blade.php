@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-5 border-4 border-yellow-300 bg-indigo-600 rounded-full text-sm font-medium text-white transition duration-150 ease-in-out'
            : 'inline-flex items-center px-5 text-sm font-medium text-gray-500 hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out hover:bg-neutral-100 rounded-full';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
