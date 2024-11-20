<?php

namespace App\Http\Controllers;

use App\Mail\verifyMail;
use App\Models\User;
use App\Models\Role;
use App\Models\SaasPlatform\SubscriptionPackage;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use App\Models\SaasPlatform\SubscriptionUserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    use HasRoles;
    
    public function index()
    {
        // $users = User::with('role', 'subscription_package')->get();
        $users = User::with('role')->get();
        return view('user.user_list', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.user_add', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role_id' => 'required|exists:roles,id',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $verificationCode = rand(100000, 999999);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'profile' => $input['profile'],
            'trade_license' => $input['trade_license'],
            'password' => $input['password'],
            'verification_code' => $verificationCode,
            'role_id' => $input['role_id'],
        ]);
                                                                       
        // Send verification email
        Mail::to($request->email)->send(new verifyMail($user));


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash the password
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User added successfully!');
    }

    public function show(string $id)
    {
        $user = User::with('role.permissions')->findOrFail($id);
        return view('user.user_view', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.user_edit', ['user' => $user, 'roles' => $roles]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable',
            'role_id' => 'required|exists:roles,id',
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('delete', 'User deleted successfully!');
    }

    // public function add_subscription_form(string $id)
    // {
    //     $data['user'] = User::findOrFail($id);
    //     $data['latest_user_subscription'] = SubscriptionUserInfo::where('user_id', $id)->orderByDesc('id')->first();

    //     $data['roles'] = Role::all();
    //     $data['page_title'] = 'user subscription';

    //     $data['subscription_packages'] = SubscriptionPackage::orderBy('sl_no', 'asc')
    //         ->where('status', 1)
    //         ->get();
    //     $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
    //         ->where('status', 1)
    //         ->get();
    //     return view('user.add_subscription', $data);
    // }

    // public function store_subscription(Request $request, string $id)
    // {
    //     // return $request;

    //     $data = $request->all();

    //     $package = SubscriptionPackage::find($request->subscription_package_id);
    //     $duration = SubscriptionPackageDuration::where('id', $package->subscription_package_duration_id)->first();

    //     $duration_value = $duration->value;

    //     if ($duration->type == 1) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addDay($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 2) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addWeek($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 3) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addMonth($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 4) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addYear($duration_value)->format('Y-m-d');
    //     } else {
    //         return back()->with('error', "Something went wrong.");
    //     }
    //     // return $expire_date;

    //     $data['subscription_package_duration_id'] = $duration->id;
    //     $data['subcription_date'] = $request->subcription_date;
    //     $data['expire_date'] = $expire_date;


    //     SubscriptionUserInfo::create($data);
    //     return redirect()->route('user.index')->with('success', 'Subscription added successfully!');
    // }

    // public function view_subscription(string $id)
    // {
    //     $data['subscription_infos'] = SubscriptionUserInfo::where('user_id', $id)->get();
    //     return view('user.view_subscription', $data);
    // }

    // public function delete_subscription(string $id)
    // {
    //     $data['subscription_infos'] = SubscriptionUserInfo::where('id', $id)->delete();
    //     return redirect()->back()->with('error', 'Subscription deleted successfully!');
    // }


    // public function edit_subscription_form(string $id)
    // {
    //     $data['page_title'] = 'user subscription update';
    //     $data['subscription_info'] = SubscriptionUserInfo::find($id);

    //     $data['subscription_packages'] = SubscriptionPackage::orderBy('sl_no', 'asc')
    //         ->where('status', 1)
    //         ->get();
    //     $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
    //         ->where('status', 1)
    //         ->get();

    //     return view('user.edit_subscription', $data);
    // }

    // public function update_subscription(Request $request, string $id)
    // {

    //     $subscription_user_info = SubscriptionUserInfo::find($id);
    //     $data = $request->all();

    //     $package = SubscriptionPackage::find($request->subscription_package_id);
    //     $duration = SubscriptionPackageDuration::where('id', $package->subscription_package_duration_id)->first();

    //     $duration_value = $duration->value;

    //     if ($duration->type == 1) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addDay($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 2) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addWeek($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 3) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addMonth($duration_value)->format('Y-m-d');
    //     } elseif ($duration->type == 4) {
    //         $expire_date = Carbon::parse($request->subcription_date)->addYear($duration_value)->format('Y-m-d');
    //     } else {
    //         return back()->with('error', "Something went wrong.");
    //     }
    //     // return $expire_date;

    //     $data['subcription_date'] = $request->subcription_date;
    //     $data['expire_date'] = $expire_date;
    //     $data['subscription_package_duration_id'] = $duration->id;

    //     $subscription_user_info->update($data);

    //     return redirect()->route('user_subscription.view', $subscription_user_info->user_id)->with('success', 'Subscription added successfully!');
    // }
}
