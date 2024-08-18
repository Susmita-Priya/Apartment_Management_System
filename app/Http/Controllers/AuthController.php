<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {

        return view('auth.login');
    }

    public function auth_login(Request $request)
    {

        // dd($request->all());
        if(Auth::attempt(['email' => $request->email , 'password'=> $request->password]))
        {
            return redirect('/index')->with('success', 'User updated successfully!');
        }
        else{
            return redirect()->back()->with('error',"Please Enter Correct Email and Password");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
