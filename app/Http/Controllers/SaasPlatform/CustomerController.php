<?php

namespace App\Http\Controllers\SaasPlatform;

use App\Http\Controllers\Controller;
use App\Models\SaasPlatform\Customer;
use Illuminate\Http\Request;

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
        $customer = Customer::find($id);
        $customer->update(['status' => 1]);
        return back()->with('success', "Customer approved.");
    }
    
    public function reject(string $id)
    {
        $customer = Customer::find($id);
        $customer->update(['status' => 0]);
        return back()->with('success', "Customer rejected.");
    }

    public function destroy(string $id)
    {
        Customer::find($id)->delete();
        return back()->with('error', "Data delete successfully!");
    }
}
