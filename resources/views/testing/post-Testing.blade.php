<x-app-layout>
{{-- User: {{$user->id}} --}}

<br>
<br>

<div x-data="{ count: 0 }">
    <h1 x-text="count"></h1>
    <button x-on:click="count++">Increment</button>
</div>
<br>
<br>

<h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
Followers:
<br>
{{-- {{dd($post->likes()[0])}} --}}
{{-- Post: {{$post->id}} --}}
<br>
<br>
{{-- Logic here:{{$user->editComment($post, 'edited')}} --}}
<br>
<br>
{{-- {{dd($user->comments)}} --}}

</x-app-layout>