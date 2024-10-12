<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class UserService implements UserServiceInterface
{
  /**
  * Retrieve all resources and paginate.
  */
  public function list($perPage = 10)
  {
    return UserResource::collection(User::query()->orderBy('id', 'desc')->paginate($perPage));
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(array $data)
  {
    return User::create($data);
  }

  /**
   * Get Details for editing the specified resource.
   */
  public function find($id)
  {
    return User::findOrFail($id);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(array $data, $id)
  {
    $user = User::findOrFail($id);
    $user->update($data);

    return $user;
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy($id)
  {
    $user = User::findOrFail($id);
    return $user->delete();
  }

  /**
   * Display a listing of the resource with softdeletes.
   */
  public function trashed($perPage = 10)
  {
      return UserResource::collection(User::query()->onlyTrashed()->orderBy('id', 'desc')->paginate($perPage));
  }

  /**
   * Restore resource with soft-deleted user.
   */
  public function restore($id)
  {
      $user = User::withTrashed()->findOrFail($id);
      $user->restore();

      return $user;
  }

  /**
   * Permanently delete a soft-deleted user.
   */
  public function forceDelete($id)
  {
      $user = User::withTrashed()->findOrFail($id);
      $user->forceDelete();

      return $user;
  }

  public function hash(string $key) {

  }

}