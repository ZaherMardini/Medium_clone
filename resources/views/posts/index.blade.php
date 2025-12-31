<x-app-layout>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <x-categories/>
    {{-- Flow bite component --}}

    <div class="post_container flex justify-center flex-wrap">
      @forelse ($posts as $post)
        <x-post class="mb-5"
        :post="$post"
        :link="route('post.show', ['user'=> $post->user->name, 'post' => $post])">
        <x-like-comment-btn :post="$post"/>
      </x-post>
      @empty
        <div class="text-gray-400 my-12">No posts to show</div>
      @endforelse
    </div>
    {{$posts->links()}}
  </div>

    {{-- end Flow bite component --}}
</x-app-layout>
