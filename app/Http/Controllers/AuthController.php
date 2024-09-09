<?php

namespace App\Http\Controllers;

use App\Models\SaasPlatform\SubscriptionPackage;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {

        // dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/index')->with('successlogin', 'Login Successfull!');
        } else {
            return redirect()->back()->with('error', "Please Enter Correct Email and Password");
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
