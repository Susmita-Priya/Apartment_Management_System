<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\SaasPlatform\SubscriptionPackage;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

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

    public function register(Request $request)
    {
        return view('auth.register');
    }


    public function do_register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:255|unique:users',
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->assignRole($request->input('role'));
        $user->save();

        return redirect()->route('login')->with('success', "Registration successfull.");
        } catch (\Exception $e) {
            return $e->getMessage();
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
