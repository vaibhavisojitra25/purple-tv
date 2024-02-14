<?php

namespace App\Http\Controllers;

use App\ChannelReport;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ChannelReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $reports = ChannelReport::where('app_id', $request->app_id)->latest()->get();
            return DataTables::of($reports)
                ->rawColumns([])
                ->addIndexColumn()
                ->make(true);
        } else {
            abort(404);
        }
    }
}
