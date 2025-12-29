@props(['user'])

@if (Auth::user()->id !== $user->id) {{--Prevent self following--}}
  <div
    x-data="{
      following: @js($user->isFollowedBy(Auth::id())),
      followers: @js($user->followers()->count()),
      follow(){
        axios.post('/follow/{{$user->id}}')
        .then(res=>{
          this.following = !this.following
          this.followers = res.data.followers
        })
        .catch( err => {console.log(err)} )
      }
    }"
  > 
  {{$slot}}
    <button 
      class="p-1 rounded-md text-white my-3"
      @click="follow()"
      x-text="following ? 'Unfollow' : 'Follow'" 
      :class="following ? 'bg-red-700' : 'bg-emerald-700'"
    >
    </button>
  </div>
@endif