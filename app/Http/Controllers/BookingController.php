<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bookings = Booking::with(['customer', 'room.roomType'])->get();

        return view('booking.index', ['data' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $customers = User::isCustomer()->get();

        return view('booking.create', ['data' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {

        $data = $request->validated();

        if ($request->ref == 'front') {

            Booking::create($data);

            $sessionData = [
                'selected_customer_id' => $request->selected_customer_id,
                'room_id' => $request->room_id,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'total_adults' => $request->total_adults,
                'total_children' => $request->total_children,
                'total_price' => $request->total_price,
                'ref' => $request->ref,
            ];
            Session::put('id', $request->selected_customer_id);

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
                        'unit_amount' => $request->total_price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8000/profile',
                'cancel_url' => 'http://localhost:8000/booking/fail',
            ]);

            return redirect($session->url);
        } else {

            if ($request->ref == 'front') {
                $data['ref'] = 'front';
            } else {
                $data['ref'] = 'admin';
            }
            Booking::create($data);

            return redirect('admin/booking/create')->with('success', 'Booking has been added.');
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
        Booking::where('id', $id)->delete();

        return redirect('admin/booking')->with('success', 'Data has been deleted.');
    }

    // Check Avaiable rooms
    public function availableRooms(Request $request, $check_in_date)
    {
        // Convert check-in and check-out dates to Carbon instances
        $checkIn = Carbon::parse($check_in_date);
        $checkOut = Carbon::parse($request->input('check_out_date'));

        // Retrieve all room IDs that have bookings overlapping with the specified dates
        $bookedRoomIds = Booking::where(function ($query) use ($checkIn, $checkOut) {
            $query->where('check_in_date', '<', $checkOut)
                ->where('check_out_date', '>', $checkIn);
        })->pluck('room_id');

        // Fetch available rooms by excluding the booked room IDs
        $availableRooms = Room::whereNotIn('id', $bookedRoomIds)->with('roomType')->get();

        return response()->json(['data' => $availableRooms]);
    }

    public function frontBooking()
    {
        return view('front-booking');
    }

    public function bookingPaymentSuccess(Request $request)
    {

        \Stripe\Stripe::setApiKey('sk_test_51OMRXTSHiH2ZGoiqndX5Jm0X3z8ry0pl9cDBqhBMq5SdFfoNyLrsOG3K7lnFlk1ZPHLKyxL16rxzvgzEcBnOolnZ00GaQPEHxi');
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));

        if ($session->payment_status == 'paid') {

            $data = new Booking;
            $data->customer_id = session('customer_id');
            $data->room_id = session('room_id');
            $data->checkin_date = session('checkin_date');
            $data->checkout_date = session('checkout_date');
            $data->total_adults = session('total_adults');
            $data->total_children = session('total_children');

            if (session('ref') == 'front') {
                $data->ref = 'front';
            } else {
                $data->ref = 'admin';
            }
            $data->save();

            return view('booking.success');
        }
    }

    public function bookingPaymentFail(Request $request)
    {
        return view('booking.failure');
    }
}
