<?php

namespace App\Http\Controllers;

use App\App;
use App\AppPrivateMenu;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class AppPrivateMenuController extends Controller
{
    public function index(Request $request)
    {
        $app = App::find($request->app_id);
        if (Auth::user()->can('View Private Menu') || $app->hasPermissionTo('View Private Menu')) {
            if ($request->ajax()) {
                $menus = AppPrivateMenu::where('app_id', $request->app_id)->latest()->get();
                return DataTables::of($menus)
                    ->editColumn('addtion_app_icon', function ($row) {
                        if (!empty($row->addtion_app_icon)) {
                            return '<img src="' . url('/uploads/app_menu', $row->addtion_app_icon) . '" width="50px">';
                        } else {
                            return '';
                        }
                    })
                    ->editColumn('addtion_app_status', function ($row) {
                        switch ($row->addtion_app_status) {
                            case 0:
                                // Inactive
                                $title = 'Inactive';
                                $class = 'badge-secondary';
                                break;
                            case 1:
                                // Active
                                $title = 'Active';
                                $class = 'badge-success';
                                break;
                        }
                        $badge = '<span class="badge badge-pill py-2 status-badge ' . $class . '">' . $title . '</span>';
                        return $badge;
                    })
                    ->addColumn('action', function ($row) use ($app) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit Private Menu') || $app->hasPermissionTo('Edit Private Menu')) {
                            $action .= ' <a href="javascript:void(0);" onclick="editAppMenu(' . str_replace('"', '\'', json_encode($row)) . ', \'' . url('/uploads/app_menu', $row->addtion_app_icon) . ' \')" class="action-btn bg-warning">
                        <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete Private Menu') || $app->hasPermissionTo('Delete Private Menu')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="deleteAppMenu(\'' . route('appmenu.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                        <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['addtion_app_icon', 'addtion_app_status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            } else {
                abort(404);
            }
        } else {
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $app = App::find($request->app_id);
        if (Auth::user()->hasAnyPermission(['Create Private Menu', 'Edit Private Menu']) || $app->hasAnyPermission(['Create Private Menu', 'Edit Private Menu'])) {
            $validator = Validator::make($request->all(), [
                'addtion_app_name' => 'required',
                'addtion_app_pkg' => 'required',
                'addtion_app_url' => 'required',
                'addtion_app_icon' => 'required_without:menu_id|mimes:jpg,jpeg,png',
            ]);
            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors()->first();
            } else {
                if (!empty($request->menu_id)) {
                    $menu = AppPrivateMenu::find($request->menu_id);
                } else {
                    $menu = new AppPrivateMenu();
                    $menu->app_id = $request->app_id;
                }
                $menu->addtion_app_name = $request->addtion_app_name;
                $menu->addtion_app_pkg = $request->addtion_app_pkg;
                $menu->addtion_app_url = $request->addtion_app_url;
                $menu->addtion_app_status = $request->addtion_app_status == 'on' ? 1 : 0;
                if ($request->hasFile('addtion_app_icon')) {
                    $image = $request->file('addtion_app_icon');
                    $name = Str::uuid() . "." . $image->extension();
                    $image->move(public_path('uploads/app_menu'), $name);
                    $menu->addtion_app_icon = $name;
                }
                $menu->save();
                $response = [
                    'success' => true,
                    'message' => 'Menu saved.',
                ];
            }
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        $menu = AppPrivateMenu::findOrFail($id);
        $app = App::find($menu->app_id);
        if (Auth::user()->can('Delete Private Menu') || $app->hasPermissionTo('Delete Private Menu')) {
            $menu->delete();
            $response = [
                'success' => true,
                'message' => 'Menu deleted.',
            ];
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }
}
