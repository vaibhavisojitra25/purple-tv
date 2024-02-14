@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/apps/apps.js"></script>
@if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']))
<script>
    var tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('apps.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'app_code', name: 'app_code', sClass: "align-middle table-image"},
            {data: 'app_name', name: 'app_name', sClass: "align-middle table-image"},
            {data: 'package_name', name: 'package_name', sClass: "align-middle"},
            {data: 'app_type', name: 'app_type', sClass: "align-middle"},
            {data: 'app_icon', name: 'app_icon', sClass: "align-middle", orderable: false, searchable: false},
            {data: 'created_at', name: 'created_at', sClass: "align-middle"},
            {data: 'status', name: 'status', sClass: "align-middle"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true,
        initComplete: function(settings, json) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    function updateStatus(id, value, isApproved = 1) {
        var confirmMsg;
        if(value == 0) {
            confirmMsg = "Are you sure about to inactive this app?";
        } else if(value == 1) {
            confirmMsg = isApproved == 1 ? "Are you sure about to active this app?" : "Are you sure about to approve this app?";
        } else if(value == 2) {
            confirmMsg = "Are you sure about to reject this app?";
        } else {
            confirmMsg = "Are you sure about to update status?";
        }
        notie.confirm({
            text: confirmMsg,
            submitText: 'Yes',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    data: {id: id, value: value},
                    url: "{{ route('acceptRejectApp') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (response) {
                        toastr.success(response.message);
                        tableData.ajax.reload();
                    },
                    error: function (err) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        });
    }
</script>
@endif
<script>
    function resetApp(appId) {
        notie.confirm({
            text: 'Are you sure you want to reset app?',
            submitText: 'Yes',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    data: {app_id: appId},
                    url: "{{ route('resetApp') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (response) {
                        toastr.success(response.message);
                        tableData.ajax.reload();
                    },
                    error: function (err) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        });
    }
</script>
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Apps</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Apps</li>
        </ol>
        @if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']) || Auth::user()->hasPermissionTo('Create App'))
        <div class="page-actions">
            <a href="{{route('apps.create')}}" class="btn btn-theme">
                <i class="icon-fa icon-fa-plus"></i> Add New App
            </a>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12">
            @if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']))
            <div class="card">
                <div class="card-header">
                    <h6>Apps</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="usersDatatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>App Code</th>
                                    <th>App Name</th>
                                    <th>App Package Name</th>
                                    <th>App Type</th>
                                    <th>App Icon</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h6>Apps</h6>
                </div>
            </div>
            <div class="row">
                @if(Auth::user()->hasAnyPermission(['View App', 'Edit App', 'Delete App', 'Manage App']))
                @if(sizeof($apps) > 0)
                @foreach ($apps as $app)
                <div class="col-12 col-md-3">
                    <div class="tvapp-main p-3 mb-4 bg-white">
                        <a href="{{ route('apps.show', $app->id) }}" class="text-center app-icon mb-3">
                            <img src="{{ url('/uploads/apps/', $app->app_icon) }}" alt="">
                        </a>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tr>
                                    <th scope="row">App Code :-</th>
                                    <td>{{ $app->app_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">App Name :-</th>
                                    <td>{{ $app->app_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Package Name :-</th>
                                    <td>{{ $app->package_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">App Type :-</th>
                                    <td>{{ $app->app_type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status :-</th>
                                    <td>
                                        @php
                                        switch ($app->status) {
                                        case -1:
                                        // Pending
                                        $title = 'Pending';
                                        $class = 'badge-warning';
                                        break;
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
                                        case 2:
                                        // Rejected
                                        $title = 'Rejected';
                                        $class = 'badge-danger';
                                        break;
                                        }
                                        @endphp
                                        <span class="badge badge-pill py-2 px-4 {{ $class }}">{{ $title }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr class="mt-0">
                        <div class="text-center">
                            @can('Edit App')
                            <a href="{{ route('apps.edit', $app->id) }}" class="btn btn-secondary">Edit</a>
                            @endcan
                            @can('Manage App')
                            <a href="{{ route('apps.show', $app->id) }}" class="btn btn-primary">Manage</a>
                            <a href="javascript:void(0);" onclick="resetApp({{ $app->id }})"
                                class="btn btn-danger">Reset</a>
                            @endcan
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h4 class="text-muted mb-0">App not found</h4>
                        </div>
                    </div>
                </div>
                @endif
                @else
                <div class="col-12">
                    <div class="access-denied-main">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/admin/img/access-denied.png') }}" alt="">
                                <h4 class="text-muted">You don't have permission to view app</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@stop