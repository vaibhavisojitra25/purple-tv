<?php

namespace App\Http\Controllers;

use App\App;
use App\InAppAnnouncement;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class InAppAnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $app = App::find($request->app_id);
        if (Auth::user()->can('View In-App Announcement') || $app->hasPermissionTo('View In-App Announcement')) {
            if ($request->ajax()) {
                $announcements = InAppAnnouncement::where('app_id', $request->app_id)->latest()->get();
                return DataTables::of($announcements)
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $title = 'Active';
                            $class = 'badge-success';
                        } else {
                            $title = 'Inactive';
                            $class = 'badge-danger';
                        }
                        $badge = '<span class="badge badge-pill py-2 status-badge ' . $class . '">' . $title . '</span>';
                        return $badge;
                    })
                    ->editColumn('image', function ($row) {
                        if (!empty($row->image)) {
                            return '<img src="' . url('/uploads/inappannouncements') . '/' . $row->image . '" width="50px">';
                        } else {
                            return '';
                        }
                    })
                    ->addColumn('action', function ($row) use ($app) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit In-App Announcement') || $app->hasPermissionTo('Edit In-App Announcement')) {
                            $action .= ' <a href="javascript:void(0);" onclick="editAnnouncement(' . str_replace('"', '\'', json_encode($row)) . ', \'' . url('/uploads/inappannouncements', $row->image) . '\')" class="action-btn bg-warning">
                        <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete In-App Announcement') || $app->hasPermissionTo('Delete In-App Announcement')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="deleteAnnouncement(\'' . route('inappannouncement.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                        <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['status', 'image', 'action'])
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
        if (
            Auth::user()->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement']) ||
            $app->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement'])
        ) {
            $validator = Validator::make($request->all(), [
                'app_id' => 'required',
                'title' => 'required',
                'short_description' => 'required',
                'image' => 'mimes:jpg,jpeg,png',
            ]);
            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors()->first();
            } else {
                if ($request->has('announcement_id') && !empty($request->announcement_id)) {
                    $announcement = InAppAnnouncement::find($request->announcement_id);
                    $message = "Announcement updated.";
                } else {
                    $announcement = new InAppAnnouncement();
                    $announcement->app_id = $request->app_id;
                    $message = "Announcement added.";
                }
                $announcement->title = $request->title;
                $announcement->short_description = $request->short_description;
                $announcement->status = $request->status == 'on' ? 1 : 0;
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $name = Str::uuid() . ".png";
                    $image->move(public_path('uploads/inappannouncements'), $name);
                    $announcement->image = $name;
                }
                $announcement->save();
                $response = [
                    'success' => true,
                    'message' => $message,
                ];
            }
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        $announcement = InAppAnnouncement::findOrFail($id);
        $app = App::find($announcement->app_id);
        if (Auth::user()->can('Delete In-App Announcement') || $app->hasPermissionTo('Delete In-App Announcement')) {
            $announcement->delete();
            $response = [
                'success' => true,
                'message' => 'Announcement deleted.',
            ];
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }
}
