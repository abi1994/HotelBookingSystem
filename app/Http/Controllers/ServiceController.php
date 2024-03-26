<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Service::all();
        return view('service.index',['data'=>$data]);
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
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'small_desc'=>'required',
            'detail_desc'=>'required',
            'photo'=>'required',
        ]);

        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('temp');
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $imgPath="/uploads/".$fileName;
            // $imgPath=$request->file('photo')->store('public/imgs');
        }else{
            $imgPath=null;
        }
        
        $data=new Service;
        $data->title=$request->title;
        $data->small_desc=$request->small_desc;
        $data->detail_desc=$request->detail_desc;
        $data->photo=$imgPath;
        $data->save();

        return redirect('admin/service/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Service::find($id);
        return view('service.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Service::find($id);
        return view('service.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required',
            'small_desc'=>'required',
            'detail_desc'=>'required'
        ]);

        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('temp');
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);

            $imgPath="/uploads/".$fileName;
            // $imgPath=$request->file('photo')->store('public/imgs');
        }else{
            $imgPath=$request->prev_photo;
        }
        
        $data=Service::find($id);
        $data->title=$request->title;
        $data->small_desc=$request->small_desc;
        $data->detail_desc=$request->detail_desc;
        $data->photo=$imgPath;
        $data->save();

        return redirect('admin/service/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::where('id',$id)->delete();
        return redirect('admin/service')->with('success','Data has been deleted.');
    }
}
