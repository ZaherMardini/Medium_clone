<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    public function posts(){
      return $this->hasMany(Post::class);
    }


// ++++++++++ Like feature ++++++++++ \\

    public function likes() {
      return $this->hasMany(Like::class);
    }

    public function liked(Post $post){
      return $post->likes()->where('user_id', Auth::id())->exists();
    }

    public function like(Post $post){
      if($this->liked($post)){
        // delete the record from the likes table, should be toggle, but i don't know how
        $this->likes()->where('post_id', $post->id)->delete();
      }else{
        Like::create(['user_id' => $this->id, 'post_id' => $post->id]);
      }
    }
// ++++++++++ End Like feature ++++++++++ \\

// ++++++++++ Comment feature ++++++++++ \\
  public function comments(){
    return $this->hasMany(Comment::class);
  }

  public function comment(Post $post, string $body){
    Comment::create(['user_id' => $this->id, 'post_id' => $post->id, 'body' => $body]);
  }

  public function editComment(Post $post, string $body){
    Comment::where(['user_id' => $this->id, 'post_id' => $post->id])->update(['body' => $body]);
  }
// ++++++++++ End Comment feature ++++++++++ \\

// ++++++++++ Follow feature ++++++++++ \\
  public function follow(User $user){
    if($this->id !== $user->id){
        $user->followers()->toggle($this);
        return true;
    }
    return false;
  }

    public function followers(){
        return $this->belongsToMany(User::class, 'user_follower',
         'user_id', 'follower_id');
    }

    public function following(){
        return $this->belongsToMany(User::class, 'user_follower',
         'follower_id', 'user_id');
    }

    public function isFollowedBy(int $user_id){
      if($user_id !== $this->id){
        $followers = $this->followers;
        foreach ($followers as $follower) {
          if($follower->id === $user_id){
            return true;
          }
        }
      }
      return false;
    }

    // ++++++++++ End Follow feature ++++++++++ \\

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
