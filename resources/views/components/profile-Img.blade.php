@props(['src' => '', 'size' => ''])

@php
  $styles = "object-cover rounded-base w-full";
  $attributeDefaults = ['class' => $styles];
@endphp

<div class="flex justify-center items-center {{$size}}">
  <img src="{{Storage::url($src)}}" {{$attributes->merge($attributeDefaults)}}>
</div>