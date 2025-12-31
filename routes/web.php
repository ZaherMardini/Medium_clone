<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestingController::class, 'test']);
Route::get('/category/{category:id}', [PostController::class, 'postBycategory'])->name('byCategory.show');
Route::get('/@{user:name}/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/popular/@{user:name}', [PostController::class, 'popular'])->name('post.pop');


Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function(){
  Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
  Route::post('/post/create', [PostController::class, 'store']);

  Route::post('/follow/{user:id}', [FollowController::class, 'toggleFollowing'])->name('follow');
  
  Route::post('/like/{post:id}', [LikeController::class, 'like']);
  
  Route::post('/comment/{post:id}', [CommentController::class, 'store']);
  
  Route::get('/@{user:name}', [PublicProfileController::class, 'show'])->name('profile.show');
});
Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/post/{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit');
  Route::post('/post/{post}', [PostController::class, 'update'])->name('post.update');
  Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.delete');
});

require __DIR__.'/auth.php';
