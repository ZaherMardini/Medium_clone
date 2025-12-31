@props(['post', 'buttonStyle' => ''])

<div class="relative {{ $buttonStyle }}">

    {{-- LIKE + COMMENT BUTTON ROW --}}
    <div class="flex gap-3 items-center">

        {{-- LIKE --}}
        <div
            x-data="{
                isAuthenticated: @js(Auth::check()),
                liked: @js(Auth::check() ? Auth::user()->liked($post) : false),
                likes: @js($post->likes()->count()),
                like(){
                    if (!this.isAuthenticated) return alert('Login first.');
                    axios.post('/like/{{$post->id}}')
                        .then(res => {
                            this.liked = !this.liked
                            this.likes = res.data.likes
                        })
                }
            }"
        >
            <i 
                @click="like()"
                :class="liked
                    ? 'fa-solid fa-thumbs-up mx-1 text-gray-500 cursor-pointer'
                    : 'fa-regular fa-thumbs-up mx-1 text-gray-500 cursor-pointer'"
            ></i>

            <span x-text="likes" class="text-gray-700"></span>
        </div>

        {{-- COMMENT BUTTON --}}
        <div
            x-data="{
                isAuthenticated: @js(Auth::check()),
                viewPanel: false,
                comments: @js($post->comments),
                count: @js($post->comments()->count()),
                newComment: '',
                comment(){
                    if (!this.isAuthenticated) return alert('Login first.');
                    if (!this.newComment.trim()) return;

                    axios.post('/comment/{{$post->id}}', { body: this.newComment })
                        .then(res => {
                            this.comments = res.data.comments
                            this.newComment = ''
                            this.count = res.data.count
                        })
                }
            }"
            class="flex items-center gap-1 relative"
        >
            <i class="fa-regular fa-comment text-gray-500 cursor-pointer"
               @click="viewPanel = !viewPanel"></i>

            <span x-text="count" class="text-gray-700"></span>

            {{-- FLOATING COMMENT PANEL --}}
            <div x-show="viewPanel"
                 @click.outside="viewPanel = false"
                 class="absolute left-0 bottom-0 mt-2 w-80 max-h-64 overflow-y-auto
                        bg-[#131c2f] border border-gray-700 rounded-lg
                        shadow-lg p-3 z-20">

                <template x-for="comment in comments" :key="comment.id">
                    <div class="p-2 border-b border-gray-700">
                        <div class="flex justify-between text-gray-200">
                            <p x-text="comment.body"></p>
                            <span class="text-xs opacity-75" x-text="comment.user.name"></span>
                        </div>
                    </div>
                </template>

                {{-- Write comment --}}
                <textarea
                    class="w-full border border-gray-700 bg-[#0f1828] text-white rounded p-2 mt-2"
                    placeholder="Write comment..."
                    x-model="newComment"
                ></textarea>

                <button
                    class="mt-2 px-4 py-1 bg-blue-500 text-white rounded w-full"
                    @click="comment()">
                    Post
                </button>
            </div>

        </div>
        @can('modify-post', $post)
        <div class="flex gap-5 ml-50">
          <div>
            <a class="text-gray-500" href="{{ route('post.edit', ['post' => $post]) }}">
             <i class="fa-solid fa-pen"></i>
            </a>
          </div>
          
          <div>
            <form action="{{ route('post.delete', ['post' => $post]) }}" method="post">
              @csrf
              @method('delete')
              <button type="submit"><i class="text-gray-500 fa-solid fa-trash"></i></button>
            </form>
          </div>
        </div>
        @endcan
    </div>




</div>
