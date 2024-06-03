<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::with('image')->get();

        return view('banner.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();

        $newBanner = Banner::create($data);

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $newBanner->image()->create(['filename' => $fileName]);

        }

        return redirect('admin/banner/create')->with('success', 'Banner has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Banner::find($id);

        return view('banner.show', ['data' => $data->load('image')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Banner::find($id);

        return view('banner.edit', ['data' => $data->load('image')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBannerRequest $request, $id)
    {
        $data = $request->validated();

        $banner = Banner::findOrFail($id);

        $banner->update($data);

        $banner->refresh();

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $banner->image()->update(['filename' => $fileName]);

        }

        return redirect('admin/banner/'.$banner->id.'/edit')->with('success', 'Banner has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::where('id', $id)->delete();

        return redirect('admin/banner')->with('success', 'Banner has been deleted.');
    }
}
