<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomerLoginRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Customer::all();
        return view('customer.index',['data'=>$data]);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'mobile'=>'required',
            'address'=>'nullable',
        ]);

        $customerDetail = collect($data)->except('password')->toArray();


        Customer::create(
           $customerDetail + ['password' => Hash::make($data['password'])]
        );

        $ref=$request->ref;


        if($ref=='front'){
            return redirect('login')->with('success','Data has been saved.');
        }

        return redirect('admin/customer/create')->with('success','Data has been added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Customer::find($id);
        return view('customer.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Customer::find($id);
        return view('customer.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'mobile'=>'required',
        ]);

        if($request->hasFile('photo')){
            $imgPath=$request->file('photo')->store('public/imgs');
        }else{
            $imgPath=$request->prev_photo;
        }

        $data=Customer::find($id);
        $data->full_name=$request->full_name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->photo=$imgPath;
        $data->save();


        return redirect('admin/customer/'.$id.'/edit')->with('success','Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::where('id',$id)->delete();
       return redirect('admin/customer')->with('success','Data has been deleted.');
    }

    // Login
    public function login(){
        return view('frontlogin');
    }

    // Check Login
    public function customer_login(CustomerLoginRequest $request)
    {

        $credentials = $request->only('email', 'password');    

        $customer = Customer::where(
            ['email'=> $credentials['email'] ])->firstOrFail();

            if ($customer) {
                if (Hash::check($credentials['password'], $customer->password)) {
                    session(['customerlogin'=> true,'data'=>$customer]);
                    return redirect('/');
                }
            }

        return redirect('login')->with('error','Invalid email/password!!');
      
    }

    // register
    public function register(){
        return view('register');
    }

    // Logout
    public function logout(){
        session()->forget(['customerlogin','data']);
        return redirect('login');
    }
}
