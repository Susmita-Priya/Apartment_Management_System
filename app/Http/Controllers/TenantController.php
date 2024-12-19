<?php

namespace App\Http\Controllers;

use App\Models\LeaseRequest;
use App\Models\Tenant;
use App\Models\User;
use App\Models\TenantContactInfo;
use App\Models\TenantDriverInfo;
use App\Models\TenantEmergencyContact;
use App\Models\TenantPersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class TenantController extends Controller
{

    public function index()
    {
        $tenants = TenantContactInfo::where('status', 1)->get();
        return view('tenant.tenant_list', compact('tenants'));
    }


    public function tenantRegistration(Request $request, $type = 'contact-info', $id = null)
    {

        $contactInfo = null;
        $personalInfo = null;
        $driverInfo = null;
        $emergencyContact = null;

        if ($id) {
            $contactInfo = TenantContactInfo::find($id);
            $personalInfo = TenantPersonalInfo::where('contact_info_id', $id)->first();
            $driverInfo = TenantDriverInfo::where('contact_info_id', $id)->first();
            $emergencyContact = TenantEmergencyContact::where('contact_info_id', $id)->first();
        }

        if ($request->isMethod('post')) {

            if ($type === 'contact-info') {
                if ($contactInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'full_name' => 'required|string',
                        'email' => 'required|email',
                        'phone' => 'required|string|min:11|max:11',
                        'address' => 'nullable|string',
                    ]);

                    // Update existing contact info
                    $contactInfo->update([
                        'full_name' => $request->input('full_name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                    ]);
                    
                    $personalInfo = TenantPersonalInfo::where('contact_info_id', $contactInfo->id)->first();
                    if ($personalInfo) {
                        $personalInfo->update([
                            'contact_info_id' => $contactInfo->id,
                        ]);
                    }
                    $user = User::where('email', $contactInfo->email)->first();
                    if ($user) {
                        $user->update(
                            [
                                'name' =>  $contactInfo->full_name,
                                'email' =>  $contactInfo->email,
                            ]
                        );
                    }
                    if ($request->filled('password')) {
                        $contactInfo->update([
                            'password' => Hash::make($request->input('password')),
                        ]);
                        $user->update(
                            [
                                'password' =>  $contactInfo->password,
                            ]
                        );
                    }

                } else {
                    // Validation
                    $request->validate([
                        'full_name' => 'required|string',
                        'email' => 'required|email',
                        'phone' => 'required|string|min:11|max:11',
                        'address' => 'nullable|string',
                    ]);

                    // Create new contact info
                    $contactInfo = new TenantContactInfo([
                        'full_name' => $request->input('full_name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                        'password' => Hash::make($request->input('password')),
                    ]);
                    $contactInfo->save();

                    // Pass contact info id in personal info table column contact_info_id
                    TenantPersonalInfo::create([
                        'contact_info_id' =>  $contactInfo->id,
                    ]);
                    User::create([
                        'name' =>  $contactInfo->full_name,
                        'email' =>  $contactInfo->email,
                        'password' =>  $contactInfo->password,
                    ]);

                    $role = Role::updateOrCreate(['name' => 'Tenant']);
                    $user = User::where('email', $contactInfo->email)->first();
                    $user->assignRole('Tenant');
                }
            } elseif ($type === 'personal-info') {
                // Create or update personal info
                if ($contactInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'fathers_name' => 'required|string',
                        'mothers_name' => 'required|string',
                        'nid' => 'required|string',
                        'tax_id' => 'required|string',
                        'passport_no' => 'nullable|string',
                        'driving_license' => 'nullable|string',
                        'religion' => 'required|string',
                        'marital_status' => 'required|string',
                        'gender' => 'required|string',
                        'dob' => 'required|date',
                        'total_family_members' => 'required|integer',
                        'occupation' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $personalInfo = TenantPersonalInfo::updateOrCreate(
                        ['contact_info_id' => $contactInfo->id],
                        [
                            'fathers_name' => $request->input('fathers_name'),
                            'mothers_name' => $request->input('mothers_name'),
                            'nid' => $request->input('nid'),
                            'tax_id' => $request->input('tax_id'),
                            'passport_no' => $request->input('passport_no'),
                            'driving_license' => $request->input('driving_license'),
                            'religion' => $request->input('religion'),
                            'marital_status' => $request->input('marital_status'),
                            'gender' => $request->input('gender'),
                            'dob' => $request->input('dob'),
                            'total_family_members' => $request->input('total_family_members'),
                            'occupation' => $request->input('occupation'),
                        ]
                    );

                    TenantDriverInfo::updateOrCreate([
                        'contact_info_id' =>  $contactInfo->id,
                    ]);
                }
            } elseif ($type === 'driver-info') {
                // Create or update driver info
                if ($contactInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'full_name' => 'nullable|string',
                        'email' => 'nullable|email',
                        'phone' => 'nullable|min:11|max:11',
                        'driving_license' => 'nullable|string',
                        'address' => 'nullable|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $driverInfo = TenantDriverInfo::updateOrCreate(
                        ['contact_info_id' => $contactInfo->id],
                        [
                            'full_name' => $request->input('full_name'),
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'driving_license' => $request->input('driving_license'),
                            'address' => $request->input('address'),
                        ]
                    );

                    TenantEmergencyContact::updateOrCreate([
                        'contact_info_id' =>  $contactInfo->id,
                    ]);
                }
            } elseif ($type === 'emergency-contact') {
                // Create or update emergency contact info
                if ($contactInfo) {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'full_name' => 'required|string',
                        'relationship' => 'required|string',
                        'email' => 'required|email',
                        'phone' => 'required|string|min:11|max:11',
                        'address' => 'required|string',
                    ]);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }

                    $emergencyContact = TenantEmergencyContact::updateOrCreate(
                        ['contact_info_id' => $contactInfo->id],
                        [
                            'full_name' => $request->input('full_name'),
                            'relationship' => $request->input('relationship'),
                            'email' => $request->input('email'),
                            'phone' => $request->input('phone'),
                            'address' => $request->input('address'),
                        ]
                    );

                    return redirect()->back()
                        ->with('success', 'Registration Successful!');
                } else {
                    return redirect()->back()->with('error', 'Contact Info not found!');
                }
            }
            // Redirect to the next step
            $nextStep = $this->getNextStep($type);
            return redirect()->route('tenant.create', ['type' => $nextStep, 'id' => $contactInfo->id]);
        }
        // Pass data to the view
        return view('tenant.tenant_add', compact('id', 'type', 'contactInfo', 'personalInfo', 'driverInfo', 'emergencyContact'));
    }


    private function getNextStep($currentStep)
    {
        //Define the order of steps and their corresponding next steps
        $stepsOrder = [
            'contact-info' => 'personal-info',
            'personal-info' => 'driver-info',
            'driver-info' => 'emergency-contact',
            'emergency-contact' => 'null',
        ];
        return $stepsOrder[$currentStep] ?? 'contact-info';
    }

    public function show($id)
    {
        $tenantContactInfo = TenantContactInfo::find($id);
        $tenantPersonalInfo = TenantPersonalInfo::where('contact_info_id', $id)->first();
        $tenantDriverInfo = TenantDriverInfo::where('contact_info_id', $id)->first();
        $tenantEmergencyContact = TenantEmergencyContact::where('contact_info_id', $id)->first();
        $tenant = [
            'contact-info' => $tenantContactInfo,
            'personal-info' => $tenantPersonalInfo,
            'driver-info' => $tenantDriverInfo,
            'emergency-contact' => $tenantEmergencyContact,
        ];
        
        return view('tenant.tenant_show', compact('tenant'));
    }
    
    public function destroy($id)
    {
        $tenant = TenantContactInfo::find($id);
        TenantContactInfo::find($id)->delete();
        TenantPersonalInfo::where('contact_info_id', $id)->delete();
        TenantDriverInfo::where('contact_info_id', $id)->delete();
        TenantEmergencyContact::where('contact_info_id', $id)->delete();

        // Delete the corresponding user
        $user = User::where('email', $tenant->email)->first();
        if ($user) {
            $user->delete();
        }
        return back()->with('success', 'Tenant deleted successfully');
    }
}
