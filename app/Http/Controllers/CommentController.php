<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function index(Comment $comments){
  }
  public function show(){

  }
  public function store(Request $request, Post $post){
    $request->validate([
      'body' => 'required'
    ]);
    Comment::create(['user_id' => Auth::id(), 'post_id' => $post->id, 'body' => $request->body]);
    $post->load('comments.user');
    $newComments = $post->comments()->with('user')->latest()->get();
    $newCount = $post->comments()->count();
    return response()->json(['comments' => $newComments, 'count' => $newCount]);
  }
  public function update(){

  }
  public function delete(){

  }
}
