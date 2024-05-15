<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Roomtypeimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=RoomType::all();
        return view('roomtype.index',['data'=>$data]);
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
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'price'=>'required',
            'detail'=>'required',
        ]);

        $data=new RoomType;
        $data->title=$request->title;
        $data->detail=$request->detail;
        $data->price=$request->price;
        $data->save();

        foreach($request->file('imgs') as $img){

            $path = $img->store('temp');
            $file = $img;
            $fileName = $file->getClientOriginalName();

            $file->move(public_path('uploads'), $fileName);

            $imgPath="/uploads/".$fileName;



            // $imgPath=$img->store('temp');
            $imgData=new Roomtypeimage;
            $imgData->room_type_id=$data->id;
            $imgData->img_src=$imgPath;
            $imgData->img_alt=$request->title;
            $imgData->save();

            // $imgPath=$img->store('public/imgs');
            // $imgData=new Roomtypeimage;
            // $imgData->room_type_id=$data->id;
            // $imgData->img_src=$imgPath;
            // $imgData->img_alt=$request->title;
            // $imgData->save();
        }

        return redirect('admin/roomtype/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=RoomType::find($id);
        return view('roomtype.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=RoomType::find($id);
        return view('roomtype.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=RoomType::find($id);
        $data->title=$request->title;
        $data->detail=$request->detail;
        $data->price=$request->price;
        $data->save();

        if($request->hasFile('imgs')){
            foreach($request->file('imgs') as $img){
                $file = $img;
                $fileName = $file->getClientOriginalName();
                
                $file->move(public_path('uploads'), $fileName);

                $imgPath="/uploads/".$fileName;
                
                // $imgPath=$img->store('public/imgs');
                $imgData=new Roomtypeimage;
                $imgData->room_type_id=$data->id;
                $imgData->img_src=$imgPath;
                $imgData->img_alt=$request->title;
                $imgData->save();
            }
        }

        return redirect('admin/roomtype/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RoomType::where('id',$id)->delete();
       return redirect('admin/roomtype')->with('success','Data has been deleted.');
    }

    public function destroy_image($img_id)
    {
        $data=Roomtypeimage::where('id',$img_id)->first();
        Storage::delete($data->img_src);

       Roomtypeimage::where('id',$img_id)->delete();
       return response()->json(['bool'=>true]);
    }
}
