<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Monarobase\CountryList\CountryListFacade as Countries;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Users', 'Create Users', 'Edit Users', 'Delete Users'])) {
            if ($request->ajax()) {
                if (Auth::user()->hasRole('SuperAdmin')) {
                    $users = User::latest()->get();
                } else {
                    $users = User::whereHas('roles', function ($query) {
                        return $query->where('name', '!=', 'SuperAdmin');
                    })->latest()->get();
                }
                return DataTables::of($users)
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $title = 'Active';
                            $class = 'badge-success';
                        } else {
                            $title = 'Inactive';
                            $class = 'badge-danger';
                        }
                        if (Auth::user()->hasPermissionTo('Active Deactive Users')) {
                            $badge = '<span class="badge badge-pill cursor-pointer py-2 status-badge ' . $class . '" onclick="updateStatus(' . $row->id . ')">' . $title . '</span>';
                        } else {
                            $badge = '<span class="badge badge-pill py-2 status-badge ' . $class . '">' . $title . '</span>';
                        }
                        return $badge;
                    })
                    ->editColumn('created_at', function ($row) {
                        return date('d M Y', strtotime($row->created_at));
                    })
                    ->addColumn('role', function (User $row) {
                        $roles = $row->roles->pluck('name')->toArray();
                        if (sizeof($roles) > 0) {
                            return '<span class="badge badge-pill py-2 status-badge badge-secondary">' . $roles[0] . '</span>';
                        } else {
                            return '-';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit Users')) {
                            $action .= ' <a href="' . route('users.edit', $row->id) . '" class="action-btn bg-warning">
                            <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete Users')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('users.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        if (Auth::user()->hasRole('SuperAdmin') && !$row->hasRole('SuperAdmin')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-success" onclick="takeAccess(\'' . route('impersonate', $row->id) . '\', \'' . route('viewProfile') . '\', \'' . route('impersonate.leave') . '\')">
                            <i class="icon-fa icon-fa-eye"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['status', 'role', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.users.index');
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Users')) {
            $roles = Role::where('name', '!=', 'SuperAdmin')->get();
            return view('admin.users.create')->with('roles', $roles);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Users')) {
            $request->validate([
                'full_name' => 'required',
                'email' => 'required|email:rfc,dns|unique:users',
                'phone_number' => 'required|numeric|digits_between:4,15',
                'username' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
                'role' => 'required'
            ]);

            $user = new User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            if ($request->has('skype_id')) {
                $user->skype_id = $request->skype_id;
            }
            if ($request->has('telegram_id')) {
                $user->telegram_id = $request->telegram_id;
            }
            $user->save();
            $user->assignRole($request->role);
            flash()->success('User created.');
            return redirect()->route('users.index');
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Users')) {
            $user = User::find($id);
            $roles = Role::where('name', '!=', 'SuperAdmin')->get();
            return view('admin.users.edit')->with('user', $user)->with('roles', $roles);
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Users')) {
            $request->validate([
                'full_name' => 'required',
                'phone_number' => 'required|numeric|digits_between:4,15',
                'role' => 'required'
            ]);

            $user = User::findOrFail($id);
            $user->full_name = $request->full_name;
            $user->phone_number = $request->phone_number;
            if ($request->has('skype_id')) {
                $user->skype_id = $request->skype_id;
            }
            if ($request->has('telegram_id')) {
                $user->telegram_id = $request->telegram_id;
            }
            $user->save();
            $user->syncRoles([$request->role]);
            flash()->success('User updated.');
            return redirect()->route('users.index');
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Delete Users')) {
            $user = User::findOrFail($id);
            $user->delete();
            flash()->success('User deleted.');
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function changeUserStatus(Request $request)
    {
        if (Auth::user()->hasPermissionTo('Active Deactive Users')) {
            $user = User::findOrFail($request->id);
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();
            $response = [
                'success' => true,
                'message' => 'Status updated',
            ];
            return response()->json($response, 200);
        } else {
            flash()->error('User does not have the right permissions.');
            return response()->json([], 200);
        }
    }

    public function getProfile()
    {
        $user = User::findOrFail(Auth::user()->id);
        $countries = Countries::getList('en');
        return view('admin.profile.index')->with('user', $user)->with('countries', $countries);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'app_image' => 'mimes:jpg,jpeg,png',
            'full_name' => 'required',
            'phone_number' => 'required|numeric|digits_between:4,15',
            'country' => 'required',
            'current_password' => 'required_with:new_password',
            'new_password' => 'required_with:current_password'
        ]);
        $user = User::findOrFail(Auth::user()->id);
        if (!empty($request->current_password) && !empty($request->new_password)) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
            } else {
                flash()->error('Enter valid password.');
                return redirect()->back();
            }
        }
        $user->full_name = $request->full_name;
        $user->phone_number = $request->phone_number;
        $user->country = $request->country;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $name = Str::uuid() . ".png";
            $profilePicture->move(public_path('uploads/profile_pictures'), $name);
            $user->profile_picture = $name;
        }
        $user->save();
        flash()->success('Profile updated');
        return redirect()->route('viewProfile');
    }

    public function deleteAccount()
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->delete();
        Auth::logout();
        $response = [
            'success' => true,
            'message' => 'Account Deleted',
        ];
        return response()->json($response, 200);
    }
}
