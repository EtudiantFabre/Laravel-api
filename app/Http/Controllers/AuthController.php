<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        
        //create user
        $user = User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password']),
        ]);
        $user->assignRole(Role::find(2)->name);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    public function login(Request $request) 
    {
        //validate fields
        $attrs = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($attrs)) {
            return response(['message' => 'Invalid credentials.'], 403);
        }

        //  return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout successfully!'
        ], 200);
    }

    public function user()
    {
        return response(['user' => auth()->user(), 'role' => auth()->user()->getPermissionsViaRoles()], 200);
    }

    public function update(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required'
        ]);
        //dd(["ici"]);

        auth()->user()->update([
            'name' => $attrs['name'],
            //'image' => $image
        ]);

        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);
    }
    public function getUser()
    {
        
    }

}