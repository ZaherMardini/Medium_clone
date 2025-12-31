@props(['post', 'link'])
<div class="bg-[#0f1828] border border-gray-700 rounded-xl p-4 flex gap-4">

    {{-- LEFT SIDE: TEXT --}}
    <div class="flex-1 flex flex-col justify-between">

        <a href="{{ $link }}" class="block">
            <h5 class="text-2xl font-bold text-white mb-2">
                {{ $post->title }}
            </h5>

            <p class="text-gray-300 mb-4">
                {{ Str::words($post->content, 20) }}
            </p>

            <button
                class="inline-flex items-center px-4 py-2 text-sm rounded-lg
                       bg-white text-black hover:bg-gray-200 transition">
                Read more
                <svg class="w-4 h-4 ms-2" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M5 12h14m-7-7 7 7-7 7" />
                </svg>
            </button>
        </a>

        {{-- SLOT: LIKE / COMMENT BUTTONS --}}
        <div class="mt-4 pt-3 border-t border-gray-700">
            {{ $slot }}
        </div>
    </div>

    
    @can('modify-post', $post)
    <div>
      <a class="text-white" href="{{ route('post.edit', ['post' => $post]) }}">edit</a>
    </div>
    
    <div>
      <form action="{{ route('post.delete', ['post' => $post]) }}" method="post">
        @csrf
        @method('delete')
        <x-primary-button>delete</x-primary-button>
      </form>
    </div>
    @endcan
    

    {{-- RIGHT SIDE: IMAGE --}}
    <div class="w-48 shrink-0">
        <img src="{{ Storage::url($post->Image) }}"
             class="rounded-lg object-cover w-full h-full">
    </div>

</div>
