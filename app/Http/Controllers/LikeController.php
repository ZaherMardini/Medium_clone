<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
  public function like(Post $post){
    $liked = Auth::user()->liked($post);
    if($liked){
      $post->likes()->where('post_id', $post->id)->where('user_id', Auth::id())->delete();
    }else{
      Like::create(['user_id' => Auth::id(), 'post_id' => $post->id]);
    }
    $likes = $post->likes()->count();
    return response()->json(['likes' => $likes]);
  }
}
