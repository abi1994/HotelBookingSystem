<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $bookings = $user->bookings; // Assuming the User model has a 'bookings' relationship

        return view('profile', compact('user', 'bookings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            if ($user->photo) {
                Storage::delete('public/profile_images/' . $user->photo);
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile_images', $imageName);

            $user->photo = $imageName;
        }

        $user->save();

        return redirect()->back()->with('status', 'Profile updated successfully.');
    }
}

