<?php

namespace App\Http\Controllers\SaasPlatform;

use App\Http\Controllers\Controller;
use App\Models\SaasPlatform\Customer;
use App\Models\SaasPlatform\SubscriptionPackage;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function website()
    {
        $data['page_title'] =  'customer';
        $data['subscription_packages'] = SubscriptionPackage::orderBy('sl_no', 'asc')
            ->where('status', 1)
            ->get();

        // $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
        //     ->where('status', 1)
        //     ->get();

        return view('saas-platform.website', $data);
    }

    public function register(Request $request)
    {

        $data['subscription_packages'] = SubscriptionPackage::orderBy('sl_no', 'asc')
            ->where('status', 1)
            ->get();

        $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
            ->where('status', 1)
            ->get();

        if ($request->package_id) {
            $data['selected_package_data'] = SubscriptionPackage::find($request->package_id);
        } else {
            $data = [];
        }
        return view('saas-platform.register', $data);
    }

    public function do_registration(Request $request)
    {
        // return $request;
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $data = $request->all();
        $data = $request->all();
        Customer::create($data);
        return redirect()->route('website')->with('success', "Registration successfull.");
    }


    public function username_validation(Request $request)
    {
        $username = $request->input('username');
        // return $username;

        $isExists = User::where('name', $username)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }

    public function emailCheck(Request $request)
    {
        $email = $request->input('email');
        $isExists = User::where('email', $email)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }

    
}
