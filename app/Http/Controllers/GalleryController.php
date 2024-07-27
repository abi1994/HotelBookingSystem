<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class GalleryController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('gallery.index', compact('rooms'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('rooms', 'public');

        Room::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('gallery.index');
    }
}

