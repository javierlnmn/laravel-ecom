@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} @if (isset($placeholder)) @endif {!! $attributes->merge(['class' => 'border-zinc-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm']) !!}>
