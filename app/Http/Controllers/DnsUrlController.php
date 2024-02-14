<?php

namespace App\Http\Controllers;

use App\App;
use App\DnsUrl;
use Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class DnsUrlController extends Controller
{
    public function index(Request $request)
    {
        $app = App::find($request->app_id);
        if (Auth::user()->can('View DNS') || $app->hasPermissionTo('View DNS')) {
            if ($request->ajax()) {
                $urls = DnsUrl::where('app_id', $request->app_id)->latest()->get();
                return DataTables::of($urls)
                    ->addColumn('action', function ($row) use ($app) {
                        $action = '';
                        if (Auth::user()->hasPermissionTo('Edit DNS') || $app->hasPermissionTo('Edit DNS')) {
                            $action .= ' <a href="javascript:void(0);" onclick="editDnsUrl(' . str_replace('"', '\'', json_encode($row)) . ')" class="action-btn bg-warning">
                        <i class="icon-fa icon-fa-pencil-square-o"></i>
                        </a>';
                        }
                        if (Auth::user()->hasPermissionTo('Delete DNS') || $app->hasPermissionTo('Delete DNS')) {
                            $action .= ' <a href="javascript:void(0);" class="action-btn bg-danger" onclick="deleteDnsUrl(\'' . route('dnsurl.destroy', $row->id) . '\', \'' . csrf_token() . '\')">
                        <i class="icon-fa icon-fa-trash"></i>
                        </a>';
                        }
                        return $action;
                    })
                    ->rawColumns(['action'])
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
        if (Auth::user()->hasAnyPermission(['Create DNS', 'Edit DNS']) || $app->hasAnyPermission(['Create DNS', 'Edit DNS'])) {
            $validator = Validator::make($request->all(), [
                'url' => 'required',
                'dns_title' => 'required'
            ]);
            if ($validator->fails()) {
                $response['success'] = false;
                $response['message'] = $validator->errors()->first();
            } else {
                if (!empty($request->dns_id)) {
                    $dnsUrl = DnsUrl::find($request->dns_id);
                } else {
                    $dnsUrl = new DnsUrl();
                    $dnsUrl->app_id = $request->app_id;
                }
                $dnsUrl->dns_title = $request->dns_title;
                $dnsUrl->url = $request->url;
                $dnsUrl->live_dns = $request->live_dns;
                $dnsUrl->epg_dns = $request->epg_dns;
                $dnsUrl->movie_dns = $request->movie_dns;
                $dnsUrl->series_dns = $request->series_dns;
                $dnsUrl->catchup_dns = $request->catchup_dns;
                $dnsUrl->save();
                $response = [
                    'success' => true,
                    'message' => 'DNS URL saved.',
                ];
            }
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }

    public function destroy($id)
    {
        $dnsUrl = DnsUrl::findOrFail($id);
        $app = App::find($dnsUrl->app_id);
        if (Auth::user()->can('Delete DNS') || $app->hasPermissionTo('Delete DNS')) {
            $dnsUrl->delete();
            $response = [
                'success' => true,
                'message' => 'DNS URL deleted.',
            ];
            return response()->json($response, 200);
        } else {
            abort(403);
        }
    }
}
