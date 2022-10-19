<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use Carbon\Carbon;

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

    public function AdminLogout()
    {
      Auth::guard('admin')->logout(); 
      return redirect()->route('login_from')->with('error','Admin LogOut Successfully'); 
    }//End method

    public function AdminRegister()
    {
       return view('admin.admin_register'); 
    }//End method


    public function AdminRegisterCreate(Request $request)
    {
       // dd($request->all());
        admin::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'created_at'=> Carbon::now(),
        ]);

         return redirect()->route('login_from')->with('error','Admin Created Successfully');

    }//End method
}
