<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SellerController extends Controller
{
    public function Index()
    {
        return view('seller.seller_login');
    }//End Method

    public function SellerDashboard()
    {
         return view('seller.index');
    }//End Method

    public function SellerLogin(Request $request)
    {
          $check = $request->all();
        if(Auth::guard('seller')->attempt(['email'=>$check['email'],'password'=>$check['password']]))
        {
            return redirect()->route('seller.dashboard')->with('error','Seller LogIn Successfully');
        }else{
            return back()->with('error','Invalid Email Or Password');
        }
    }//End Method
}
