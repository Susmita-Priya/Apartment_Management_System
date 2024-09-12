<?php

namespace App\Http\Controllers\SaasPlatform;

use App\Http\Controllers\Controller;
use App\Models\SaasPlatform\SubscriptionPackage;
use App\Models\Role;
use App\Models\SaasPlatform\SubscriptionPackageDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionPackageController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Package';
        $data['subscription_packages'] = SubscriptionPackage::orderBy('sl_no', 'asc')
            ->get();
        return view('saas-platform.subscription-package.index', $data);
    }

    public function create(Request $request)
    {
        $pakage_id = SubscriptionPackage::orderBy('id', 'DESC')->first();
        $data['roles'] = Role::where('status', 1)->get();
        if (!empty($pakage_id)) {
            $id_no =  (++$pakage_id->id);
        } else {
            $id_no = 1;
        }
        $data['sl_no'] = $id_no;
        $data['page_title'] = 'Package';

        $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
        ->where('status', 1)
        ->get();


        return view('saas-platform.subscription-package.create_edit', $data);
    }
    public function store(Request $request)
    {
        // return $request->all();
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        SubscriptionPackage::create($data);
        return redirect()->back()->with('success', 'User Subscritption Package Created Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['subscription_package'] = SubscriptionPackage::find($id);
        $data['roles'] = Role::where('status', 1)->get();
        $data['page_title'] = 'Package';
        $data['subscription_package_durations'] = SubscriptionPackageDuration::orderBy('type', 'asc')
        ->where('status', 1)
        ->get();
        return view('saas-platform.subscription-package.create_edit', $data);
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
        $subscription_package = SubscriptionPackage::find($id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $subscription_package->update($data);
        return redirect()->route('subscription_package.index')->with('success', 'User Subscritption Package Updated Successfully');
    }

    public function destroy($id)
    {
        $delete = SubscriptionPackage::find($id)->delete();
        return redirect()->back()->with('error', 'User Subscritption Package Deleted Successfully');
    }
}
