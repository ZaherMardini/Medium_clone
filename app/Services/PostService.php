<?php

namespace App\Services;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostService{
  protected $request;
  protected $validInfo;
  public function setRequest(StorePostRequest $request){
    $this->request = $request;
    $this->validInfo = $request->validated();
  }
  public function index(){
    $user = Auth::user();
    $posts = Post::with(['Category', 'User' ,'comments', 'likes', 'comments.user']);
    if($user){
      $ids = $user->following()->pluck('user_id');
      $ids->add(Auth::id());
      $posts->whereIn('user_id', $ids);
    }
    return $posts;
  }
  public function viewByCategory(Category $category){
    $posts = $this->index();
    $posts->where('category_id', $category['id']);
    return $posts;
  }
  public function handlePostInfo(){
    if($this->request->hasFile('file')){
      $img = $this->request->file('file');
      $imgname = Str::uuid() . '.' . $img->getClientOriginalExtension();
      $path = $img->storeAs('images', $imgname, 'public');
      $this->validInfo['slug'] = Str::slug($this->request['title']);
      $this->validInfo['Image'] = $path;
      unset($this->validInfo['file']);
      $this->validInfo['user_id'] = Auth::id();
    }
  }
  public function store(){
    $this->handlePostInfo();
    Post::create($this->validInfo);
  }
  public function update(Post $post){
    $this->handlePostInfo();
    $post->update($this->validInfo);
  }
}