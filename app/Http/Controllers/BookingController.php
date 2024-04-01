<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Booking;
use Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $bookings=Booking::all();
        return view('booking.index',['data'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        var_dump("create Start");exit();
        $customers=Customer::all();
        return view('booking.create',['data'=>$customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        var_dump("Strip Start");
        // exit();

        $request->validate([
            'customer_id'=>'required',
            'room_id'=>'required',
            'checkin_date'=>'required',
            'checkout_date'=>'required',
            'total_adults'=>'required',
        ]);

        if($request->ref=='front'){
            var_dump($request->customer_id);
            // exit();
            $sessionData=[
                'customer_id'=>$request->customer_id,
                'room_id'=>$request->room_id,
                'checkin_date'=>$request->checkin_date,
                'checkout_date'=>$request->checkout_date,
                'total_adults'=>$request->total_adults,
                'total_children'=>$request->total_children,
                'roomprice'=>$request->roomprice,
                'ref'=>$request->ref
            ];
            Session::put('id', $request->customer_id);
            // var_dump(Session::get('id'));exit();

            session($sessionData);

            \Stripe\Stripe::setApiKey('sk_test_51OMRXTSHiH2ZGoiqndX5Jm0X3z8ry0pl9cDBqhBMq5SdFfoNyLrsOG3K7lnFlk1ZPHLKyxL16rxzvgzEcBnOolnZ00GaQPEHxi');
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                  'price_data' => [
                    'currency' => 'lkr',
                    'product_data' => [
                      'name' => 'Room Booking',
                    ],
                    'unit_amount' => $request->roomprice*100,
                  ],
                  'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8000/',
                'cancel_url' => 'http://localhost:8000/booking/fail',
            ]);
            var_dump("if end");

            // exit();
            return redirect($session->url);
        }else{
            var_dump("else end");
            // exit();
            $data=new Booking;
            $data->customer_id=$request->customer_id;
            $data->room_id=$request->room_id;
            $data->checkin_date=$request->checkin_date;
            $data->checkout_date=$request->checkout_date;
            $data->total_adults=$request->total_adults;
            $data->total_children=$request->total_children;
            if($request->ref=='front'){
                $data->ref='front';
            }else{
                $data->ref='admin';
            }
            $data->save();
            return redirect('admin/booking/create')->with('success','Data has been added.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Booking::where('id',$id)->delete();
        return redirect('admin/booking')->with('success','Data has been deleted.');
    }

    // Check Avaiable rooms
    function available_rooms(Request $request,$checkin_date){
        $arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");

        $data=[];
        foreach($arooms as $room){
            $roomTypes=RoomType::find($room->room_type_id);
            $data[]=['room'=>$room,'roomtype'=>$roomTypes];
        }

        return response()->json(['data'=>$data]);
    }

    public function front_booking()
    {
        return view('front-booking');
    }

    function booking_payment_success(Request $request){
        var_dump("payment success ");
            // exit();
        \Stripe\Stripe::setApiKey('sk_test_51OMRXTSHiH2ZGoiqndX5Jm0X3z8ry0pl9cDBqhBMq5SdFfoNyLrsOG3K7lnFlk1ZPHLKyxL16rxzvgzEcBnOolnZ00GaQPEHxi');
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));

        if($session->payment_status=='paid'){
            // dd(session('customer_id'));
            $data=new Booking;
            $data->customer_id=session('customer_id');
            $data->room_id=session('room_id');
            $data->checkin_date=session('checkin_date');
            $data->checkout_date=session('checkout_date');
            $data->total_adults=session('total_adults');
            $data->total_children=session('total_children');

            var_dump(Session::get('id'));
            var_dump($session);
            var_dump(session('checkin_date'));
            var_dump(session('checkout_date'));
            var_dump(session('total_adults'));
            var_dump(session('total_children'));
            exit();

            if(session('ref')=='front'){
                $data->ref='front';
            }else{
                $data->ref='admin';
            }
            $data->save();
            return view('booking.success');
        }
    }

    function booking_payment_fail(Request $request){
        return view('booking.failure');
    }
}
