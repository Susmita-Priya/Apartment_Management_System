<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Floor;
use App\Models\Landlord;
use App\Models\Room;
use App\Models\Stall;
use App\Models\Tenant;
use App\Models\TenantContactInfo;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function adminIndex()
    {
        $building = Building::where('company_id',Auth::user()->id)
                    ->where('status',1)->count();
        // dd($building);
        $floor = Floor::where('company_id',Auth::user()->id)->count();
        $unit = Unit::where('company_id',Auth::user()->id)->count();
        $room = Room::where('company_id',Auth::user()->id)->count();
        $stall = Stall::where('company_id',Auth::user()->id)->count();
        $users = User::all();
        return view('admin_dashboard.index',compact('building','floor','unit','room','stall','users'));
    }
}
