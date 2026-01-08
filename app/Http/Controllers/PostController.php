<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
  protected $service;
  public function __construct(PostService $service)
  {
    $this->service = $service;
  }
  public function index()
  {
    $posts = $this->service->index();
    $posts = $posts->latest()->simplePaginate(5);
    return view('posts.index', ['posts' => $posts]);
  }

  public function create()
  {
    $c = Category::get();
    return view('posts.create', ['categories' => $c]);
  }
  public function edit(Post $post)
  {
    if(Auth::user()->cannot('modify-post', $post)){
        abort(403, 'Unauthorized');
    }
    $c = Category::where('id', $post['category_id'])->first();
    $cs = Category::get();
    return view('posts.edit', ['user' => $post->user, 
                      'postCategory' => $c,
                      'categories' => $cs, 
                      'post' => $post]);
  }
  public function destroy(Post $post){
    if(Auth::user()->cannot('modify-post', $post)){
      abort(403, 'Unauthorized');
    }
    $post->delete();
    return redirect()->route('dashboard');
  }
  public function update(Post $post, StorePostRequest $request){
    $this->service->setRequest($request);
    $this->service->update($post);
    return redirect()->route('dashboard');
  }
  public function store(StorePostRequest $request)
  { 
    $this->service->setRequest($request);
    $this->service->store();
    return redirect()->route('dashboard');
  }

  public function postBycategory(Category $category){ 
    if($category['id'] == 1){
      return redirect()->route('dashboard');
    }
    $posts = $this->service->viewByCategory($category);
    $posts = $posts->latest()->simplePaginate(5);
    return view('posts.index', ['posts' => $posts]);
  }
  public function show(User $user, Post $post)
  {
    $post->load('comments.user');
    return view('posts.show', ['user' => $user, 'post' => $post]);
  }
}