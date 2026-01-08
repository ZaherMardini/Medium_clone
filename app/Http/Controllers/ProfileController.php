<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
      return view('profile.edit', [
        'user' => $request->user(),
      ]);
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
      $info = $request->validated();
      $img = $request->file('file') ?? null;
      $cover_img = $request->file('cover') ?? null;
      if($img){
          $imgname = Str::uuid() . '.' . $img->getClientOriginalExtension();
          $info['image'] = $img->storeAs('avatars', $imgname, 'public');
          unset($info['file']);
      }
      if($cover_img){
          $imgname = Str::uuid() . '.' . $cover_img->getClientOriginalExtension();
          $info['cimage'] = $cover_img->storeAs('avatars', $imgname, 'public');
          unset($info['cover']);
      }
      $request->user()->fill($info);
      if ($request->user()->isDirty('email')) {
          $request->user()->email_verified_at = null;
      }

      $request->user()->save();

      return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
      $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
      ]);
      $user = $request->user();
      Auth::logout();
      $user->delete();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return Redirect::to('/');
  }
}
