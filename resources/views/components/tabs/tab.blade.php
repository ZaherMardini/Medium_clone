@php
  $styles = 'bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg'
@endphp
@props(['defaults' => $styles])

<div {{$attributes->merge(['class' => $defaults])}}>
  <div class="main_start_thing flex justify-center p-6 dark:text-gray-100">
    <div class=" text-xl font-medium text-center text-body border-b border-default">
      <ul class="flex flex-wrap -mb-px">
        {{$slot}}
      </ul>
    </div>
  </div>
</div>