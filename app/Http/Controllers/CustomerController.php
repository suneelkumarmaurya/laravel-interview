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

    public function checkEmail(Request $request){
        $email = $request->input('email');
        $phone = $request->input('phone');
        $emailExists = Customer::where('email',$email)->first();
        $phoneExists = Customer::where('phone',$phone)->first();

        if($emailExists){
            return response()->json(array("emailExists" => true));
        }
        if($phoneExists){
            return response()->json(array("phoneExist"=> true));
        }
        else{
            return response()->json(array("exists" => false));
        }
    }
}
