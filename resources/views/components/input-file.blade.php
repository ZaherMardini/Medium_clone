@php
  $style = "cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"; 
@endphp
<input {{$attributes->merge(['class'=> $style, 'id'=> 'file_input', 'type' => 'file'])}}>
