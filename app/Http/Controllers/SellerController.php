<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller;
use Carbon\Carbon;

class SellerController extends Controller
{
    public function SellerIndex()
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

    public function SellerLogout()
    {
        Auth::guard('seller')->logout(); 
      return redirect()->route('seller_login_from')->with('error','Seller LogOut Successfully'); 
    }//End Method

    public function SellerRegister()
    {
       return view('seller.seller_register'); 
    }//End Method

    public function SellerRegisterCreate(Request $request)
    {
       // dd($request->all());
        Seller::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'created_at'=> Carbon::now(),
        ]);

         return redirect()->route('seller_login_from')->with('error','Seller Created Successfully');

    }//End method
}
