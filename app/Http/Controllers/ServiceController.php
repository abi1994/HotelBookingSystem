<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::with('image')->get();

        return view('service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();

        $newService = Service::create($data);

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $newService->image()->create(['filename' => $fileName]);

        }

        return redirect('admin/service/create')->with('success', 'Service has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Service::find($id);

        return view('service.show', ['data' => $data?->load('image')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Service::find($id);

        return view('service.edit', ['data' => $data?->load('image')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServiceRequest $request, string $id)
    {
        $data = $request->validated();

        $service = Service::find($id);

        $service->update($data);

        $service->refresh();

        if ($request->hasFile('filename')) {

            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $service->image()->update(['filename' => $fileName]);

        }

        return redirect('admin/service/'.$service->id.'/edit')->with('success', 'Service has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::where('id', $id)->delete();

        return redirect('admin/service')->with('success', 'Service has been deleted.');
    }
}
