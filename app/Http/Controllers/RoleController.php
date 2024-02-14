<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Role', 'Create Role', 'Edit Role', 'Delete Role'])) {
            if ($request->ajax()) {
                $roles = Role::all();
                return DataTables::of($roles)
                    ->editColumn('created_at', function ($row) {
                        return date('d M Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit Role')) {
                            $action .= '<a href="' . route('roles.edit', $row->id) . '" class="action-btn bg-warning">
                            <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete Role')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('roles.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.roles.index');
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Role')) {
            $permissions = ["View Dashboard", "Manage Profile"];
            return view('admin.roles.create')->with('permissions', $permissions);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Role')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles',
            ]);

            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors()->first();
            } else {
                $role = new Role();
                $role->name = $request->name;
                $role->save();
                $role->syncPermissions($request->permissions);
                $response = [
                    'success' => true,
                    'message' => 'Role Created.',
                ];
            }
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Role')) {
            $role = Role::find($id);
            return view('admin.roles.edit')->with('role', $role)->with('permissions', $role->permissions->pluck('name')->toArray());
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        die;
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Role')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors()->first();
            } else {
                $role = Role::findOrFail($id);
                $role->name = $request->name;
                $role->save();

                $permissions = $request->permissions;
                if ($role->name == 'Support') {
                    $permissions = array_merge($permissions, [
                        "Send Push Notification",
                        "Update Push Notification Settings",
                        "View In-App Announcement",
                        "Create In-App Announcement",
                        "Edit In-App Announcement",
                        "Delete In-App Announcement",
                        "View DNS",
                        "Create DNS",
                        "Edit DNS",
                        "Delete DNS",
                        "View Private Menu",
                        "Create Private Menu",
                        "Edit Private Menu",
                        "Delete Private Menu",
                        "View App Images",
                        "Update App Wide Logo",
                        "Update TV Banner Image",
                        "Update Mobile Icon Image",
                        "Update Background Image",
                        "Update Splash Screen Image",
                        "Update Remote Image",
                        "View App Version",
                        "Update App Version",
                        "View App Player",
                        "Update App Player",
                        "View App Users",
                        "View About Us",
                        "Update About Us",
                        "View Support",
                        "Update Support",
                        "View VPN Config",
                        "Update VPN Config",
                        "View App Endpoint",
                        "Update App Endpoint",
                        "View API Key",
                        "Update API Key",
                        "View Theme",
                        "Update Theme",
                        "View Background",
                        "Update Background",
                        "View Ads Config",
                        "Update Ads Config",
                        "Manage App Setting",
                        "View App Configuration",
                        "Update App Configuration",
                        "View Language",
                        "Update Language",
                        "View URL",
                        "Update URL",
                        "View General Setting",
                        "Update General Setting",
                        "View App Settings",
                        "Update App Settings",
                        "View Theme Settings",
                        "Update Theme Settings",
                        "View Sub User Profile",
                        "Update Sub User Profile",
                        "View Device Type",
                        "Update Device Type",
                        "View Ticker Setting",
                        "Update Ticker Setting",
                        "View Play Setting",
                        "Update Play Setting",
                        "View Default Device",
                        "Update Default Device",
                        "View 4k Setting",
                        "Update 4k Setting",
                        "View Private Setting",
                        "Update Private Setting",
                        "View In-App Purchase",
                        "Update In-App Purchase",
                        "View Channel Reporting",
                        "Update Channel Reporting",
                        "View Movie Show Request",
                        "Update Movie Show Request",
                        "View Report Issue Email",
                        "Update Report Issue Email",
                        "View MQTT Setting",
                        "Update MQTT Setting",
                        "View Header Setting",
                        "Update Header Setting",
                        "View SMTP Setting",
                        "Update SMTP Setting",
                        "View Weather Setting",
                        "Update Weather Setting",
                        "View EPG Setting",
                        "Update EPG Setting",
                        "View Recording Setting",
                        "Update Recording Setting",
                        "View Cloud Setting",
                        "Update Cloud Setting",
                        "View P2P Setting",
                        "Update P2P Setting",
                        "View Stream Setting",
                        "Update Stream Setting",
                        "View VPN",
                        "Create VPN",
                        "Edit VPN",
                        "Delete VPN",
                        "View Plugin",
                        "Create Plugin",
                        "Edit Plugin",
                        "Delete Plugin"
                    ]);
                }
                $role->syncPermissions($permissions);
                $response = [
                    'success' => true,
                    'message' => 'Role updated.',
                ];
            }
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Delete Role')) {
            $role = Role::findOrFail($id);
            $role->delete();
            flash()->success('Role deleted.');
            return redirect()->back();
        } else {
            abort(403);
        }
    }
}
