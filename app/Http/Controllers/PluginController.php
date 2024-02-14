<?php

namespace App\Http\Controllers;

use App\Plugin;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PluginController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Plugin', 'Create Plugin', 'Edit Plugin', 'Delete Plugin'])) {
            if ($request->ajax()) {
                $plugins = Plugin::latest()->get();
                return DataTables::of($plugins)
                    ->editColumn('playstore_url', function ($row) {
                        return '<a href="' . $row->playstore_url . '" target="_blank"><img src="' . asset('assets/admin/img/playstore.png') . '"></a>';
                    })
                    ->editColumn('apk_url', function ($row) {
                        return '<a href="' . $row->apk_url . '" target="_blank"><img src="' . asset('assets/admin/img/apk-file.png') . '"></a>';
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $title = 'Active';
                            $class = 'badge-success';
                        } else {
                            $title = 'Inactive';
                            $class = 'badge-danger';
                        }
                        if (Auth::user()->hasPermissionTo('Edit Plugin')) {
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
                        if (Auth::user()->hasPermissionTo('Edit Plugin')) {
                            $action .= ' <a href="' . route('plugins.edit', $row->id) . '" class="action-btn bg-warning">
                            <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete Plugin')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('plugins.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['playstore_url', 'apk_url', 'status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.plugin.index');
        } else {
            abort(403);
        }
    }

    public function create()
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Plugin')) {
            return view('admin.plugin.create');
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Create Plugin')) {
            $request->validate([
                'name' => 'required',
                'pkg_name' => 'required',
                'version' => 'required',
                'playstore_url' => 'required',
                'apk_url' => 'required',
            ]);
            $plugin = new Plugin();
            $plugin->name = $request->name;
            $plugin->pkg_name = $request->pkg_name;
            $plugin->version = $request->version;
            $plugin->playstore_url = $request->playstore_url;
            $plugin->apk_url = $request->apk_url;
            $plugin->status = $request->status == 'on' ? 1 : 0;
            $plugin->save();
            flash()->success('Plugin created.');
            return redirect()->route('plugins.index');
        } else {
            abort(403);
        }
    }

    public function edit($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Plugin')) {
            $plugin = Plugin::find($id);
            return view('admin.plugin.edit')->with('plugin', $plugin);
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Edit Plugin')) {
            $request->validate([
                'name' => 'required',
                'pkg_name' => 'required',
                'version' => 'required',
                'playstore_url' => 'required',
                'apk_url' => 'required',
            ]);

            $plugin = Plugin::findOrFail($id);
            $plugin->name = $request->name;
            $plugin->pkg_name = $request->pkg_name;
            $plugin->version = $request->version;
            $plugin->playstore_url = $request->playstore_url;
            $plugin->apk_url = $request->apk_url;
            $plugin->status = $request->status == 'on' ? 1 : 0;
            $plugin->save();
            flash()->success('Plugin updated.');
            return redirect()->route('plugins.index');
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasPermissionTo('Delete Plugin')) {
            $plugin = Plugin::findOrFail($id);
            $plugin->delete();
            flash()->success('Plugin deleted.');
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function changePluginStatus(Request $request)
    {
        if (Auth::user()->hasPermissionTo('Edit Plugin')) {
            $plugin = Plugin::findOrFail($request->id);
            $plugin->status = $plugin->status == 1 ? 0 : 1;
            $plugin->save();
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
