<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  public function toggleFollowing(User $user){
    $user->followers()->toggle(Auth::user());
    return response()->json(['followers' => $user->followers()->count()]);
  } 
}
