<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserResource::collection(User::query()->orderBy('id', 'desc')->paginate(10));
        return view('user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $path = '';
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads', 'public');
        }

        $data = [
            "prefixname"=> $request->prefixname,
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "firstname" => $request->firstname,
            "middlename" => $request->middlename,
            "lastname" => $request->lastname,
            "suffixname" => $request->suffixname,
            "photo" => ($path) ? $path : ''
        ];
        $user = User::create($data);

        return redirect()->route('user.create')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = [
            "prefixname"=> $request->prefixname,
            "username" => $request->username,
            "email" => $request->email,
            "firstname" => $request->firstname,
            "middlename" => $request->middlename,
            "lastname" => $request->lastname,
            "suffixname" => $request->suffixname
        ];

        if(isset($request->password)) {
            $data["password"] = Hash::make($request->password);
        }

        $path = '';
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads', 'public');
            $data["photo"] = $path;
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('user.edit', $id)->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'Item deleted successfully.');
    }

    /**
     * Display a listing of the resource with softdeletes.
     */
    public function trashed()
    {
        $users = UserResource::collection(User::query()->onlyTrashed()->orderBy('id', 'desc')->paginate(10));
        return view('user.trashed', compact('users'));
    }

    /**
     * Restore resource with soft-deleted user.
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.trashed')->with('success', 'User restored successfully!');
    }

    /**
     * Permanently delete a soft-deleted user.
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('users.trashed')->with('success', 'User permanently deleted!');
    }
}
