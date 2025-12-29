<div class="my-[50px]">
  <x-tabs.tab>
    @forelse ($categories as $category)
    <x-tabs.option :link="route('byCategory.show', ['category' => $category])">
      {{$category->name}}
    </x-tabs.option>
    @empty
      
    @endforelse
  </x-tabs.tab>
</div>