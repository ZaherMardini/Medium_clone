@props(['disabled' => false, 'value' => ''])
@php
  $styles = 'p-3 mb-10 w-full border-gray-300 dark:border-gray-700 dark:bg-white dark:text-black focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm';
@endphp

<input @disabled($disabled) value= "{{$value}}"{{ $attributes->merge(['class' => $styles]) }}>