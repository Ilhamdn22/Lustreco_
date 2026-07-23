@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border border-gray-300 rounded-xl px-4 py-3 text-[14px] outline-none focus:border-black focus:ring-1 focus:ring-black transition shadow-sm']) !!}>
