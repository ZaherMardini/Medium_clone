<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function show(Category $category)
  {
    $posts = $category->posts;
    return view('posts.index', ['posts' => $posts]);
  }
}