<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('SuperAdmin')) {
            $notifications = Notification::latest()->get();
            if ($request->ajax()) {
                return DataTables::of($notifications)
                    ->editColumn('image', function ($row) {
                        if (!empty($row->image))
                            return '<img src="' . url('/uploads/notifications') . '/' . $row->image . '" width="50px">';
                        else
                            return '';
                    })
                    ->addColumn('action', function ($row) {
                        $action = '';
                        // if (Auth::user()->hasPermissionTo('Delete Notification')) {
                        $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="handleConfirmation(\'' . route('notification.destroy', $row->id) . '\', \'' . csrf_token() . '\')" data-toggle="tooltip" title="Delete">
                            <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        // }
                        return $action;
                    })
                    ->rawColumns(['image', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin.notifications.notification');
        } else {
            $notifications = Notification::latest()->get();
            return view('admin.notifications.notification')->with('notifications', $notifications);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'message' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
        } else {
            $notification = new Notification();
            $notification->title = $request->title;
            $notification->message = $request->message;
            $notification->external_link = $request->external_link;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = Str::uuid() . ".png";
                $image->move(public_path('uploads/notifications'), $name);
                $notification->image = $name;
            }
            $notification->save();
            $response = [
                'success' => true,
                'message' => 'Notification sent.',
            ];
        }
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        if (Auth::user()->can('Delete Notification')) {
            $notification = Notification::findOrFail($id);
            $notification->delete();
            $response = [
                'success' => true,
                'message' => 'Notification deleted.',
            ];
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }
}
