<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use Cookie;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
        // Login
        function login(){
            return view('login');
        }
        // Check Login
        function check_login(Request $request){
            $request->validate([
                'username'=>'required',
                'password'=>'required',
            ]);
            $admin=Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
            if($admin>0){
                $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->get();
                session(['adminData'=>$adminData]);

                if($request->has('rememberme')){
                    Cookie::queue('adminuser',$request->username,1440);
                    Cookie::queue('adminpwd',$request->password,1440);
                }

                return redirect('admin');
            }else{
                return redirect('admin/login')->with('msg','Invalid username/Password!!');
            }
        }
        // Logout
        function logout(){
            session()->forget(['adminData']);
            return redirect('admin/login');
        }

        function dashboard(){
            $bookings=Booking::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();
            $labels=[];
            $data=[];
            foreach($bookings as $booking){
                $labels[]=$booking['checkin_date'];
                $data[]=$booking['total_bookings'];
            }

            // For Pie Chart
            $rtbookings=DB::table('room_types as rt')
                ->join('rooms as r','r.room_type_id','=','rt.id')
                ->join('bookings as b','b.room_id','=','r.id')
                ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
                ->groupBy('r.room_type_id')
                ->get();
            $plabels=[];
            $pdata=[];
            foreach($rtbookings as $rbooking){
                $plabels[]=$rbooking->title;
                $pdata[]=$rbooking->total_bookings;
            }
            // End

            // echo '<pre>';
            // print_r($rtbookings);

            return view('dashboard',['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);


        }
        function forgotpassword(){
            return view('forgot-password');
        }

        public function sendResetLinkEmail(Request $request)
        {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = Password::getRepository()->create($user);

        $user->sendPasswordResetNotification($token);

        return redirect()->back()->with('status', 'We have emailed your password reset link!');
        }
}