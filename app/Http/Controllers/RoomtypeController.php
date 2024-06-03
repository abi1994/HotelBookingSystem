<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomTypeRequest;
use App\Models\RoomType;
use App\Models\Roomtypeimage;
use Illuminate\Support\Facades\Storage;

class RoomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RoomType::with('images')->get();

        return view('roomtype.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roomtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomTypeRequest $request)
    {
        $data = $request->validated();

        $newRoomType = RoomType::create(collect($data)->forget('filename')->toArray());

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $newRoomType->images()->create(['filename' => $fileName]);

        }

        return redirect('admin/roomtype/create')->with('success', 'Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RoomType::find($id);

        return view('roomtype.show', ['data' => $data->load('images')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = RoomType::find($id);

        return view('roomtype.edit', ['data' => $data->load('images')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRoomTypeRequest $request, $id)
    {

        $data = $request->validated();

        $roomType = RoomType::findOrFail($id);

        $roomType->update(collect($data)->forget('filename')->toArray());

        $roomType->refresh();

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $roomType->images()->update(['filename' => $fileName]);

        }

        return redirect('admin/roomtype/'.$roomType->id.'/edit')->with('success', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RoomType::where('id', $id)->delete();

        return redirect('admin/roomtype')->with('success', 'Data has been deleted.');
    }

    public function destroyImage($img_id)
    {
        $data = Roomtypeimage::where('id', $img_id)->first();
        Storage::delete($data->img_src);

        Roomtypeimage::where('id', $img_id)->delete();

        return response()->json(['bool' => true]);
    }
}
