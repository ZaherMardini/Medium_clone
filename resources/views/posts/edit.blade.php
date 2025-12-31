<x-app-layout>
  <h1 class="bg-white text-2xl text-center">Edit post</h1>
  <div class="flex flex-col align-center w-3/4 p-20 mx-auto">
    <form action="{{ route('post.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      {{-- Category --}}
      {{-- {{dd($postCategory->toArray())}} --}}
      <x-input-label>Category</x-input-label>
      <select name="category_id" class="mb-5 block">
        @foreach ($categories as $category)
        <option
          value="{{$category['id']}}"
          @selected((int)$postCategory['id'] === (int)$category['id'])>
          {{$category['name']}}
        </option>
        @endforeach
      </select>
      <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
      {{-- End Category --}}

      {{-- Title --}}
      <x-input-label>Title</x-input-label>
      <x-text-input name="title" class="p-5" placeholder='type something' :value="$post['title'] ?? 'Test Title'"/>
      <x-input-error :messages="$errors->get('title')" class="mt-2" />
      {{-- End Title --}}
        
      {{-- Content --}}
      <x-input-label>Content</x-input-label>
      <x-textarea-input class="mb-10" rows="4" cols="20" name="content" placeholder="type something">{{$post['content']}}</x-textarea-input>
      <x-input-error :messages="$errors->get('content')" class="mt-2" />
      {{-- End Content --}}
        
      {{-- img --}}
      <x-input-label>Upload Image</x-input-label>
      <x-input-file name="file" class="mb-10"/>
      <x-input-error :messages="$errors->get('file')" class="mt-2" />
      {{-- End img --}}

      {{-- Pubilsh --}}
      <x-input-label>Publish date</x-input-label>
      <x-text-input name="published_at" type="datetime-local" :value="$post['published_at'] ?? '2025-11-21 15:02:19'"/>
      <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
      {{-- End Publish --}}
      <x-primary-button class="my-2">Submit changes</x-primary-button>
      {{-- Bug: datetime &  datetime-local stored differently in the DB datetime not redering--}}
    </form>
  </div>
</x-app-layout>

