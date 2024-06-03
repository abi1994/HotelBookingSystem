<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Booking;
use App\Models\RoomType;
use Cookie;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Login
    public function login()
    {
        return view('login');
    }

    public function checkLogin(AdminLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        $request->session()->regenerate();

        if (Auth::attempt($credentials + ['is_admin' => true])) {
            session(['adminData' => Auth::user()]);

            if ($request->has('rememberme')) {
                Cookie::queue('adminuser', $request->username, 1440);
                Cookie::queue('adminpwd', $request->password, 1440);
            }

            return redirect('admin');

        }

        return redirect('admin/login')->with('msg', 'Invalid username/Password!!');
    }

    // Logout
    public function logout()
    {
        session()->forget(['adminData']);

        return redirect('admin/login');
    }

    public function dashboard()
    {

        [$labels, $data] = $this->getTotalBookingsPerCheckInDate();

        [$plabels, $pdata] = $this->getTotalBookingsPerRoomType();

        return view('dashboard', compact('labels', 'data', 'plabels', 'pdata'));

    }

    private function getTotalBookingsPerCheckInDate()
    {
        $bookings = Booking::selectRaw('count(id) as total_bookings, check_in_date')
            ->groupBy('check_in_date')
            ->get();

        $labels = $bookings->pluck('check_in_date')->all();
        $data = $bookings->pluck('total_bookings')->all();

        return [$labels, $data];
    }

    private function getTotalBookingsPerRoomType()
    {

        $roomTypeBookings = RoomType::withCount(['rooms', 'rooms as bookings_count' => function ($query) {
            $query->join('bookings', 'rooms.id', '=', 'bookings.room_id');
        }])->get(['name', 'rooms_count', 'bookings_count']);

        $plabels = $roomTypeBookings->pluck('name')->all();
        $pdata = $roomTypeBookings->pluck('rooms_count')->all();

        return [$plabels, $pdata];
    }
}
