<?php

namespace App\Http\Controllers\SaasPlatform;

use App\Http\Controllers\Controller;
use App\Models\SaasPlatform\Customer;
use App\Models\SaasPlatform\SubscriptionUserInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
        $data['page_title'] =  'customer';
        $data['customers'] =  Customer::orderBy('id', 'desc')->get();
        return view('saas-platform.customer.index', $data);
    }

    public function approve(string $id)
    {
        $customer = Customer::with(['subscription_package', 'duration'])->find($id);
        // return $customer;

        $customer->update(['status' => 1]);


        $duration_value = $customer->duration->value;

        if ($customer->duration->type == 1) {
            $expire_date = Carbon::parse($customer->registration_date)->addDay($duration_value)->format('Y-m-d');
        } elseif ($customer->duration->type == 2) {
            $expire_date = Carbon::parse($customer->registration_date)->addWeek($duration_value)->format('Y-m-d');
        } elseif ($customer->duration->type == 3) {
            $expire_date = Carbon::parse($customer->registration_date)->addMonth($duration_value)->format('Y-m-d');
        } elseif ($customer->duration->type == 4) {
            $expire_date = Carbon::parse($customer->registration_date)->addYear($duration_value)->format('Y-m-d');
        } else {
            return back()->with('error', "Something went wrong.");
        }

        // return $expire_date;

        $user = User::create([
            'subscription_package_id' => $customer->subscription_package_id,
            'customer_id' => $customer->id,
            'registration_date' => $customer->registration_date,
            'name' => $customer->name,
            'email' => $customer->email,
            'company_name' => $customer->company_name,
            'phone' => $customer->phone,
            'role_id' => $customer->role_id,
            'password' => bcrypt($customer->password),
            'expire_date' => $expire_date,
        ]);

        SubscriptionUserInfo::create([
            'subscription_package_id' => $customer->subscription_package_id,
            'subscription_package_duration_id' => $customer->subscription_package_duration_id,
            'package_price' => $customer->package_price,
            'discount_amount' => $customer->discount_amount,
            'payment_method' => $customer->payment_method,
            'payment_details' => $customer->payment_details,
            'subcription_date' => date('Y-m-d'),
            'expire_date' => $expire_date,
            'total_payable_amount' => $customer->subscription_package->total_payable_amount,
            'total_paid_amount' => $customer->subscription_package->total_paid_amount,
            'user_id' => $user->id,
        ]);

        return back()->with('success', "Customer approved.");
    }

    public function reject(string $id)
    {
        $customer = Customer::find($id);
        $customer->update(['status' => 0]);

        $user = User::where('customer_id', $customer->id)->first();
        $user_info_delete = SubscriptionUserInfo::where('user_id', $user->id)->delete();
        $user->delete();

        return back()->with('success', "Customer rejected.");
    }

    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $user = User::where('customer_id', $customer->id)->first();
        if(!empty($user->id)){
            $user_info_delete = SubscriptionUserInfo::where('user_id', $user->id)->delete();
            $user->delete();
        }
        $customer->delete();
        return back()->with('error', "Data delete successfully!");
    }
}
