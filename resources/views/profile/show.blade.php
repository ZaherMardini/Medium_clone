<x-app-layout>
<div class="flex">

   <div class="mid-section w-3/4 bg-gray-800 ">
      <x-profile-img :src="$user->cimage" size="w-[95%] p-5" class="h-[400px]"/>
      <div class="line w-full h-[2px] mt-5 bg-gray-500"></div>
      <div class="text-[60px] text-gray-500 font-bold ml-5 mt-5">
         {{$user->name}}
      </div>
      <x-tabs.tab> 
         <x-tabs.option>All posts</x-tabs.option>
         <x-tabs.option :link="route('post.pop', ['user' => $user])">Popular posts</x-tabs.option>
      </x-tabs.tab>
      <div class="posts">
         @foreach ($posts as $post)
        <div class="post-likes">
          <x-post class="w-[95%] mx-auto relative" 
          :post="$post"
          :link="route('post.show', ['user' => $post->user->name,'post' => $post])"
          >
          <x-like-comment-btn :post="$post"/>
          </x-post>
          {{-- <x-like-comment-btn :post="$post"/> --}}
        </div>
        @endforeach
      </div>
    </div>
    <div class="right-side w-1/4 bg-[#1b2533] p-3 border-2 border-l-[#6a7282]">
      <div class="info flex flex-col gap-3 bg-[#009eff21] p-4 text-white">
        <x-profile-img :src="$user->image"/>
          <div>{{$user->name}}<i class="fa-solid fa-share mx-2"></i>Share (button copy route)</div>
          <x-follow-btn :user="$user">
            <div ><span x-text="followers" class="mr-2"></span>Followers</div>
          </x-follow-btn>
          </div>
        </div>
      </div>
      
</x-app-layout>