<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
   public function show(User $user){
      $posts = $user->posts;
      foreach($posts as $post){
        $post->load('comments.user');
      }
      return view('profile.show', ['user' => $user, 'posts' => $posts]);
   }
}
