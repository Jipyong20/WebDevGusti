<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show($id) {
        return User::find($id);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        return User::create($validated);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
        return $user;
    }

    public function destroy($id) {
        User::destroy($id);
    }
}