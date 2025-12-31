<x-app-layout>
  
  <div class="container flex flex-col mx-auto p-3 bg-gray-400 max-w-[70%]">
    {{-- User info section --}}
    <h1 class="mx-auto text-2xl font-bold">{{$post->title}}</h1>
    <div class="flex flex-wrap gap-3 p-2">
      <img src="{{Storage::url($post->user->image)}}" class="w-[90px] h-[90px] rounded-full"/>
        <span class="flex flex-col justify-center text-gray-700">
          <div>
            <a href="{{route('profile.show', ['user' => $post->user])}}" class="font-bold">{{$user['name']}}</a>
            @auth
            <x-follow-btn :user="$post->user" />
            @endauth
          </div>
          <span>{{$post->readingTime()}} min read . {{$post->created_at->format('M d, Y')}}</span>
        </span>
    </div>
    {{-- End User info section --}}

    {{-- Likes section --}}
  <div class="w-full h-[2px] my-2 bg-gray-500 text-gray-500"></div>
  <x-like-comment-btn :post="$post"/>
  <div class="w-full h-[2px] my-2 bg-gray-500 text-gray-500"></div>

    {{-- End Likes section --}}

    {{-- content section --}}
    <div class="p-3 my-2">
      {{$post->content}}
    </div>
    {{-- End content section --}}

    {{-- Category section --}}
    <div class="p-2 bg-gray-500 text-white rounded-md w-fit">
      {{$post->category->name}}
    </div>
    {{-- End Category section --}}


    {{-- Image section --}}
    <div class="p-3 my-2">
      <x-profile-img :src="$post->Image" size="w-1/2 h-1/2 mx-auto"/>
    </div>
    {{-- End Image section --}}

  </div>
</x-app-layout> 