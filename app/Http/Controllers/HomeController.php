<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Models\RoomType;
use App\Models\Banner;
use App\Models\Service;

class HomeController extends Controller
{
    // Home Page
    function home(){
        $services=Service::all();
        $banners=Banner::where('publish_status','on')->get();
        $roomTypes=RoomType::all();
        return View('home',['roomTypes'=>$roomTypes,'services'=>$services,'banners'=>$banners]);
    }

    // Service Detail Page
    function service_detail(Request $request, $id){
        $service=Service::find($id);
        return View('servicedetail',['service'=>$service]);
    }

}


