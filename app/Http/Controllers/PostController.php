<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostController extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $posts = Post::with(['Category', 'User' ,'comments', 'likes', 'comments.user']);
    if($user){
      $ids = $user->following()->pluck('user_id');
      $ids->add(Auth::id());
      $posts->whereIn('user_id', $ids);
    }

    $posts = $posts->latest()->simplePaginate(5);
    
    return view('posts.index', ['posts' => $posts]);
  }

  public function create()
  {
    $c = Category::get();
    return view('posts.create', ['categories' => $c]);
  }

  public function store(StorePostRequest $request)
  { // super important to review and understand
    $info = $request->validated();// whatch out for the request type
    if($request->hasFile('file')){
        $img = $request->file('file');
        $imgname = Str::uuid() . '.' . $img->getClientOriginalExtension();
        $path = $img->storeAs('images', $imgname, 'public');
        $info['slug'] = Str::slug($request->title);
        $info['Image'] = $path;
        unset($info['file']);// This fucking line cost me 3 hours of crying, this resolves the bug on line 49
        $info['user_id'] = Auth::user()->id;
        Post::create($info);// it tries to take the 'file' key instead of the image path
        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }else{
      dd('image fucked');
    }
  }

  public function postBycategory(Category $category){// Duplicated the index methode here 
    if($category->id == 1){
      return redirect()->route('dashboard');
    }
    $user = Auth::user();
    $query = Post::with(['Category','User','comments']);
    if($user){
      $ids = $user->following()->pluck('user_id');
      $ids->add(Auth::id()); // if not for this line the user won't be able to see his own posts
      $query->whereIn('user_id', $ids);
    }
    $query->where('category_id', $category->id);
    $posts = $query->latest()->simplePaginate(5);
    
    return view('posts.index', ['posts' => $posts]);
  }

  public function popularPosts(User $user){
    $posts = Post::with(['Category','User','comments', 'likes','comments.user']);
    $posts->orderBy('likes');
    return view('posts.show', ['posts' => $posts]);
  }

  public function show(string $username, Post $post)
  {
    $post->load('comments.user');
    return view('posts.show', ['username' => $username, 'post' => $post]);
  }

}