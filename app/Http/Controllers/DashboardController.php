<?php

namespace App\Http\Controllers;

use App\App;
use App\User;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'SuperAdmin')->where('name', '!=', 'Admin');
        })->count();
        $newUsers = User::whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'SuperAdmin')->where('name', '!=', 'Admin');
        })->whereRaw('created_at >= (CURDATE() - INTERVAL 3 DAY)')->count();
        $totalApps = App::count();
        $totalAdmin = User::whereHas('roles', function ($query) {
            return $query->where('name', '=', 'Admin');
        })->count();
        return view('admin.dashboard.basic')
            ->with('totalUsers', $totalUsers)
            ->with('newUsers', $newUsers)
            ->with('totalApps', $totalApps)
            ->with('totalAdmin', $totalAdmin);
    }
}
