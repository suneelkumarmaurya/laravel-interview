<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;

class CustomerController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers,email',
            'phone'=>'required',
            'Address'=>'required',
            'Pincode'=> 'required',
        ]) ;
        Customer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,

        ]);
        $Address = new CustomerAddress();
        $Address->Address = $request->Address;
        $Address->Pincode = $request->Pincode;
        $Address->save();


        return back()->with('success','Customer added successfully');
    }
}
