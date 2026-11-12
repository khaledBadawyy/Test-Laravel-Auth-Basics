<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {   
        $user = $request->user();
        $user->name = $request->validated('name');
        $user->email = $request->validated('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->validated('password'));
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
