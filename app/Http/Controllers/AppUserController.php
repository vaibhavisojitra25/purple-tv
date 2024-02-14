<?php

namespace App\Http\Controllers;

use App\App;
use App\AppUser;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppUserController extends Controller
{
    public function index(Request $request)
    {
        $app = App::find($request->app_id);
        if (Auth::user()->can('View App Users') || $app->hasPermissionTo('View App Users')) {
            if ($request->ajax()) {
                $appUsers = AppUser::where('app_id', $request->app_id)->latest()->get();
                return DataTables::of($appUsers)
                    ->rawColumns([])
                    ->addIndexColumn()
                    ->make(true);
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }
}
