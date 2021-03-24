<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(count(array_intersect(session()->get('grant'), ['SU', 'user_access']))==0)
        {
            session()->flash('error', __('global.access_denied'));
            return redirect()->back();
        }

        return view('user-management.dashboard');
    }
}
