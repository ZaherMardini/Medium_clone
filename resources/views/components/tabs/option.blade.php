@props(['link' => '#'])
@php
  $styles = "inline-block p-4 border-b border-transparent rounded-t-base hover:text-white hover:border-[#50768e]";
@endphp
<li>
  <a href={{$link}} class="{{ $styles }}">{{$slot}}</a>
</li>