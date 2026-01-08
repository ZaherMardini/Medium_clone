<?php

namespace App\Services;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileService{
  protected $request;
  protected $validInfo;

  public function setRequest(ProfileUpdateRequest $request){
    $this->request = $request;
    $this->validInfo = $request->validated();
  }
  public function update(){
    $request = $this->request;
    $img = $request->file('file') ?? null;
    $cover_img = $request->file('cover') ?? null;
    if($img){
      $info['image'] = $img->store('avatars', 'public');
      unset($info['file']);
    }
    if($cover_img){
      $info['cimage'] = $cover_img->store('avatars', 'public');
      unset($info['cover']);
    }
    $request->user()->fill($info);
    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }
    $request->user()->save();
  }
}