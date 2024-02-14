<?php

namespace App\Http\Controllers;

use App\CustomVpn;
use App\Vpn;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Monarobase\CountryList\CountryListFacade as Countries;

class VpnController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasAnyPermission(['View VPN', 'Create VPN', 'Edit VPN', 'Delete VPN'])) {
            if ($request->ajax()) {
                if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                    $vpns = Vpn::latest()->get();
                } else {
                    $vpns = CustomVpn::latest()->get();
                }
                return DataTables::of($vpns)
                    ->editColumn('file_url', function ($row) {
                        return '<a href="' . $row->file_url . '" target="_blank">' . $row->file_url . '</a>';
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $title = 'Active';
                            $class = 'badge-success';
                        } else {
                            $title = 'Inactive';
                            $class = 'badge-danger';
                        }
                        if (Auth::user()->hasPermissionTo('Edit VPN')) {
                            $badge = '<span class="badge badge-pill cursor-pointer py-2 status-badge ' . $class . '" onclick="updateStatus(' . $row->id . ')">' . $title . '</span>';
                        } else {
                            $badge = '<span class="badge badge-pill py-2 status-badge ' . $class . '">' . $title . '</span>';
                        }
                        return $badge;
                    })
                    ->editColumn('created_at', function ($row) {
                        return date('d M Y', strtotime($row->created_at));
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit VPN')) {
                            $action .= ' <a href="' . route('vpns.edit', $row->id) . '" class="action-btn bg-warning">
                            <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }

                        if (Auth::user()->hasPermissionTo('Delete VPN')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('vpns.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['file_url', 'status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.vpn.index');
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create VPN')) {
            $countries = Countries::getList('en');
            return view('admin.vpn.create')->with('countries', $countries);
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create VPN')) {
            $request->validate([
                'country' => 'required',
                'city' => 'required',
                'file_url' => 'required',
            ]);
            if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                $vpn = new Vpn();
            } else {
                $vpn = new CustomVpn();
                $vpn->user_id = Auth::user()->id;
            }
            $vpn->country = $request->country;
            $vpn->city = $request->city;
            $vpn->file_url = $request->file_url;
            $vpn->status = $request->status == 'on' ? 1 : 0;
            $vpn->save();
            flash()->success('Vpn created.');
            return redirect()->route('vpns.index');
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit VPN')) {
            if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                $vpn = Vpn::find($id);
            } else {
                $vpn = CustomVpn::find($id);
            }
            $countries = Countries::getList('en');
            return view('admin.vpn.edit')->with('vpn', $vpn)->with('countries', $countries);
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit VPN')) {
            $request->validate([
                'country' => 'required',
                'city' => 'required',
                'file_url' => 'required',
            ]);

            if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                $vpn = Vpn::find($id);
            } else {
                $vpn = CustomVpn::find($id);
            }
            $vpn->country = $request->country;
            $vpn->city = $request->city;
            $vpn->file_url = $request->file_url;
            $vpn->status = $request->status == 'on' ? 1 : 0;
            $vpn->save();
            flash()->success('Vpn updated.');
            return redirect()->route('vpns.index');
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Delete VPN')) {
            if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                $vpn = Vpn::findOrFail($id);
            } else {
                $vpn = CustomVpn::findOrFail($id);
            }
            $vpn->delete();
            flash()->success('Vpn deleted.');
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function changeVpnStatus(Request $request)
    {
        if (Auth::user()->hasPermissionTo('Edit VPN')) {
            if (Auth::user()->hasAnyRole(['SuperAdmin', 'Support'])) {
                $vpn = Vpn::findOrFail($request->id);
            } else {
                $vpn = CustomVpn::findOrFail($request->id);
            }
            $vpn->status = $vpn->status == 1 ? 0 : 1;
            $vpn->save();
            $response = [
                'success' => true,
                'message' => 'Status updated',
            ];
            return response()->json($response, 200);
        } else {
            flash()->error('You don\'t have the right permissions.');
            return response()->json([], 200);
        }
    }
}
