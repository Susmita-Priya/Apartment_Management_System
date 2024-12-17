<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class RoleController extends Controller
{
   
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    

    public function index(Request $request): View
    {
        if (Auth::user()->hasRole('Super Admin')) {
            // Super Admin sees all roles
            $roles = Role::orderBy('id', 'DESC')->paginate(5);
        } elseif (Auth::user()->hasRole('Client')) {
            // Client sees only roles for "Company" and "Client"
            $roles = Role::whereIn('name', ['Company', 'Client'])->orderBy('id', 'DESC')->paginate(5);
        } elseif (Auth::user()->hasRole('Company')) {
            // Company sees only roles for "Company"
            $roles = Role::where('name', 'Company')->orderBy('id', 'DESC')->paginate(5);
        } else {
            // Default case for other roles
            $roles = collect(); // Empty collection
        }

        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function create(): View
    {
        if (Auth::user()->hasRole('Super Admin')) {
            // Super Admin sees all permissions
            $permission = Permission::get();
        } elseif (Auth::user()->hasRole('Client')) {
            // Client sees only assigned permissions
            $permission = Auth::user()->getAllPermissions(); // Fetch permissions assigned to the client
           // dd($permission);
        } else {
            $permission = collect(); // Empty collection for other roles
        }

        return view('roles.create', compact('permission'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    public function show($id): View
    {
        $role = Role::find($id);

        if (Auth::user()->hasRole('Super Admin')) {
            // Super Admin sees all role permissions
            $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $id)
                ->get();
        } elseif (Auth::user()->hasRole('Client')) {
            // Client sees only assigned permissions
            $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $id)
                ->whereIn('permissions.id', Auth::user()->getAllPermissions()->pluck('id'))
                ->get();
        } elseif (Auth::user()->hasRole('Company')) {
            // Company sees only assigned permissions
            $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $id)
                ->whereIn('permissions.id', Auth::user()->getAllPermissions()->pluck('id'))
                ->get();
        } else {
            $rolePermissions = collect(); // Empty collection for other roles
        }

        return view('roles.show', compact('role', 'rolePermissions'));
    }
    

    public function edit($id): View
    {
        $role = Role::find($id);

        if (Auth::user()->hasRole('Super Admin')) {
            // Super Admin sees all permissions
            $permission = Permission::get();
        } elseif (Auth::user()->hasRole('Client')) {
            // Client sees only its permissions
            $permission = Auth::user()->getAllPermissions();
        } else {
            $permission = collect(); // Empty collection
        }

        $rolePermissions = FacadesDB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }
    

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
    
        $role->syncPermissions($permissionsID);
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        FacadesDB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
