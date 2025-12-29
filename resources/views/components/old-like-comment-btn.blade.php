@props(['post', 'contStyle' => ''])
<div class="flex gap-3 {{$contStyle}}">
  <div
  x-data="{
    isAuthenticated: @js(Auth::check()),
    liked: @js(Auth::check() ? Auth::user()->liked($post) : false),
    likes: @js($post->likes()->count()),
      like(){
        if (!this.isAuthenticated) {
        alert('You must be logged in to like a post.');
        return;
        }
        axios.post('/like/{{$post->id}}')
        .then(res=>{
          this.liked = !this.liked
          this.likes = res.data.likes
        })
        .catch( err => {console.log(err)} )
      }
    }"
    > 
  <i 
  @click="like()"
    :class=" liked ?
    'fa-solid fa-thumbs-up mx-1 text-gray-500 cursor-pointer' :
    'fa-regular fa-thumbs-up mx-1 text-gray-500 cursor-pointer'
  "></i>
    <span x-text="likes" class="text-gray-700 "></span>
  </div>

{{-- comments --}}

  <div
    x-data="{
      isAuthenticated: @js(Auth::check()),
      viewPanel: @js(false),
      comments: @js($post->comments),
      count: @js($post->comments()->count()),
      newComment: '',
      comment(){
      
      if (!this.isAuthenticated) {
        alert('You must be logged in to comment on a post.');
        return;
      }


      if (!this.newComment.trim()) return;
        axios.post('/comment/{{$post->id}}',{body: this.newComment})
        .then(res=>{
          this.comments = res.data.comments
          this.newComment = ''
          this.count = res.data.count
          })
          .catch( err => {console.log(err)} )
          }
        }"
        >
    <i 
    class="fa-regular fa-comment text-gray-500 cursor-pointer"
    @click="viewPanel= !viewPanel"
    ></i>
    <span x-text="count" class="text-gray-700"></span>
    <div x-show="viewPanel" class="m-2">
      <template x-for="comment in comments" :key="comment.id">
        <div class="p-2 border-b">
          <div class="flex justify-between rounded-md">
            <p x-text="comment.body"></p><span x-text="comment.user.name"></span>
          </div>
        </div>
      </template>
      {{-- new comment --}}
      <textarea class="w-full border rounded p-2 mt-2"
      placeholder="Write comment..." x-model="newComment"></textarea>
    </div>
    <button x-show="viewPanel"
    class="mt-2 px-4 py-1 bg-blue-500 text-white rounded"
    @click="comment()"
    >
    Post
    </button>
  </div>
</div>
  
  