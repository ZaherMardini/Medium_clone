<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
  protected $service;
  public function __construct(ProfileService $service)
  {
    $this->service = $service;
  }
  public function edit(Request $request): View
  {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $this->service->setRequest($request);
    $this->service->update();
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
