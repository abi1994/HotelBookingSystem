<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerRegistrationRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::isCustomer()->get();

        return view('customer.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRegistrationRequest $request)
    {
        $data = $request->validated();

        $newCustomer = User::create(
            $data + ['is_admin' => false]
        );

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $newCustomer->profileImage()->create(['filename' => $fileName]);

        }

        $ref = $request->ref;

        if ($ref == 'front') {
            return redirect('login')->with('success', 'Data has been saved.');
        }

        return redirect('admin/customer/create')->with('success', 'Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::isCustomer()->find($id);

        return view('customer.show', ['data' => $data->load('profileImage')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::isCustomer()->find($id);

        return view('customer.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRegistrationRequest $request, string $id)
    {
        $data = $request->validated();

        $customer = User::isCustomer()->find($id);

        $customer->update($data);

        $customer->refresh();

        if ($request->hasFile('filename')) {
            $fileName = Storage::disk('public')->put('/', $request->file('filename'));

            $customer->profileImage()->update(['filename' => $fileName]);

        }

        return redirect('admin/customer/'.$customer->id.'/edit')->with('success', 'Customer has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id', $id)->delete();

        return redirect('admin/customer')->with('success', 'Data has been deleted.');
    }

    // Login
    public function login()
    {
        return view('frontlogin');
    }

    // Check Login
    public function customerLogin(CustomerLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials + ['is_admin' => false])) {
            session(['customerlogin' => true, 'data' => Auth::user()]);

            return redirect('/');
        }

        return redirect('login')->with('error', 'Invalid email/password!!');

    }

    // register
    public function register()
    {
        return view('register');
    }

    // Logout
    public function logout()
    {

        session()->forget(['customerlogin', 'data']);

        return redirect('login');
    }
}
