<?php

namespace App\Http\Controllers\SaasPlatform;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionPackageDurationController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Package Duration';
        $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
            ->get();
        return view('saas-platform.subscription-package-duration.index', $data);
    }

    public function create(Request $request)
    {
        $data['roles'] = Role::where('status', 1)->get();
        $data['page_title'] = 'Package Duration';
        return view('saas-platform.subscription-package-duration.create_edit', $data);
    }
    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        SubscriptionPackageDuration::create($data);
        return redirect()->back()->with('success', 'Data Created Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['subscription_package_duration'] = SubscriptionPackageDuration::find($id);
        $data['roles'] = Role::where('status', 1)->get();
        $data['page_title'] = 'Package Duration';
        return view('saas-platform.subscription-package-duration.create_edit', $data);
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $subscription_package_duration = SubscriptionPackageDuration::find($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $subscription_package_duration->update($data);
        return redirect()->route('subscription_package_duration.index')->with('success', 'Data Updated Successfully');
    }

    public function destroy($id)
    {
        $delete = SubscriptionPackageDuration::find($id)->delete();
        return redirect()->back()->with('error', 'Data Deleted Successfully');
    }
}
