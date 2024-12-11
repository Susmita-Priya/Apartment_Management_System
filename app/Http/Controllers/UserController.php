<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        if (Auth::user()->hasRole('Super Admin')) {      // Super Admin can see all users
            $data = User::latest()->get();
        } elseif (Auth::user()->hasRole('Client')) {     // Client can see itself and its child Company users
            $data = User::where('parent_id', Auth::user()->id)
                        ->orWhere('id', Auth::user()->id)
                        ->latest()
                        ->get();
        } elseif (Auth::user()->hasRole('Company')) {    // Company can see itself and its parent Client
            $data = User::where('id', Auth::user()->id)
                        ->orWhere('id', Auth::user()->parent_id)
                        ->latest()
                        ->get();
        } else {
            $data = collect(); // Empty collection
        }
        

    $roles = Role::pluck('name', 'name')->all();

    return view('users.index', compact('data', 'roles'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }
   
    
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        if (Auth::user()->hasRole('Super Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } elseif (Auth::user()->hasRole('Client')) {
            $roles = Role::where('name', 'Company')->pluck('name', 'name')->all();
        } else {
            $roles = [];
        }

        return view('users.create',compact('roles'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['parent_id'] = Auth::user()->id;
        $input['password'] = FacadesHash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
 
    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show',compact('user'));
    }
    
    public function edit($id): View
    {
        $user = User::find($id);
        if (Auth::user()->hasRole('Super Admin')) {
            $roles = Role::pluck('name', 'name')->all();
        } elseif (Auth::user()->hasRole('Client')) {
            $roles = Role::where('name', 'Company')->pluck('name', 'name')->all();
        } else {
            $roles = [];
        }
        
        $userRole = $user->roles->pluck('name', 'name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = FacadesHash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        FacadesDB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
