<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|min:8|confirmed'
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}
