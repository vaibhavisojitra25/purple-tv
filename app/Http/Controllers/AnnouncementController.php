<?php

namespace App\Http\Controllers;

use App\Announcement;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $announcements = Announcement::latest()->get();
            if ($request->ajax()) {
                return DataTables::of($announcements)
                    ->editColumn('image', function ($row) {
                        if (!empty($row->image)) {
                            return '<img src="' . url('/uploads/announcements') . '/' . $row->image . '" width="50px">';
                        } else {
                            return '';
                        }
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $title = 'Active';
                            $class = 'badge-success';
                        } else {
                            $title = 'Inactive';
                            $class = 'badge-danger';
                        }
                        $badge = '<span class="badge badge-pill cursor-pointer py-2 status-badge ' . $class . '" onclick="updateStatus(' . $row->id . ')">' . $title . '</span>';
                        return $badge;
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        // if (Auth::user()->hasPermissionTo('Delete Announcement')) {
                        $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('announcement.destroy', $row->id) . '\', \'' . csrf_token() . '\')" data-toggle="tooltip" title="Delete">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        // }
                        return $action;
                    })
                    ->rawColumns(['image', 'status', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.announcements.announcement');
        } else {
            $announcements = Announcement::where('status', 1)->latest()->get();
            return view('admin.announcements.announcement')->with('announcements', $announcements);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'short_description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $announcement = new Announcement();
            $announcement->title = $request->title;
            $announcement->short_description = $request->short_description;
            $announcement->status = $request->status;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = Str::uuid() . ".png";
                $image->move(public_path('uploads/announcements'), $name);
                $announcement->image = $name;
            }
            $announcement->save();
            $response = [
                'success' => true,
                'message' => 'Announcement sent.',
            ];
        }
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        if (Auth::user()->can('Delete Announcement')) {
            $announcement = Announcement::findOrFail($id);
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

    public function changeAnnouncementStatus(Request $request)
    {
        $announcement = Announcement::findOrFail($request->id);
        $announcement->status = $announcement->status == 1 ? 0 : 1;
        $announcement->save();
        $response = [
            'success' => true,
            'message' => 'Status updated',
        ];
        return response()->json($response, 200);
    }
}
