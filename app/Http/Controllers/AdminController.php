<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    //
    public function Index()
    {
        return view('admin.admin_login');
    }//End method

    public function Dashboard()
    {
        return view('admin.index');
    }//End method

    public function Login(Request $request)
    {
      //  dd($request->all());

        $check = $request->all();
        if(Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password']]))
        {
            return redirect()->route('admin.dashboard')->with('error','Admin LogIn Successfully');
        }else{
            return back()->with('error','Invalid Email Or Password');
        }
    }//End method
}
