@php
    $defaultStyles = "flex flex-wrap justify-between items-center bg-[#1e2939] p-6 border border-default rounded-base shadow-xs md:flex-row  my-5";
@endphp

@props(['post', 'link'])
<div class="relative">
<a href="{{$link}}" {{$attributes->merge(['class' => $defaultStyles])}}>
    <div class="flex flex-col justify-between md:p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">{{$post->title}}</h5>
        <p class="mb-6 text-[#f3f4f6]">{{Str::words($post->content, 10)}}</p>
        <div>
            <button type="button" class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Read more
                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
            </button>
        </div>
    </div>
    <img class="object-cover max-w-[200px] max-h-full rounded-base mb-4 md:mb-0" src="{{Storage::url($post->Image)}}">
    <div>
      {{$slot ?? ''}}
    </div>
</a>
</div>