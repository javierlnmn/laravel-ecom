@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-rose-400 text-start text-base font-medium text-rose-700 bg-rose-50 focus:outline-none focus:text-rose-800 focus:bg-rose-100 focus:border-rose-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-zinc-600 hover:text-zinc-800 hover:bg-zinc-50 hover:border-zinc-300 focus:outline-none focus:text-zinc-800 focus:bg-zinc-50 focus:border-zinc-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
