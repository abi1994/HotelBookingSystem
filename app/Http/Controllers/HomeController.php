<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Home Page
    public function home()
    {
        $services = Service::with('image')->get();
        $banners = Banner::where('publish_status', 'on')->with('image')->get();
        $roomTypes = RoomType::with('images')->get();

        return View('home', ['roomTypes' => $roomTypes, 'services' => $services, 'banners' => $banners]);
    }

    // Service Detail Page
    public function serviceDetail(Request $request, $id)
    {
        $service = Service::find($id);

        return View('servicedetail', ['service' => $service]);
    }
}
