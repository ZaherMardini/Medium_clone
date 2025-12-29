<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function test(){
      $user = User::first();
      $post = Post::first();
      return view('testing.post-testing', ['user' => $user, 'post' => $post, 'result' => '']);
    }
    // $post = Post::first();
    // $likes = $post->likes();
}
