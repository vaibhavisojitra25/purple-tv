@extends('admin.layouts.layout-basic')

@section('scripts')
@if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Role', 'Edit Role', 'Delete Role']))
<script>
    var tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('roles.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'name', name: 'name', sClass: "align-middle table-image"},
            {data: 'created_at', name: 'created_at', sClass: "align-middle"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif
@can('Delete Role')
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
@endcan
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Roles</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
        @can('Create Role')
        <div class="page-actions">
            <a href="{{route('roles.create')}}" class="btn btn-theme">
                <i class="icon-fa icon-fa-plus"></i> Add New Role
            </a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>Roles</h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Role', 'Edit Role', 'Delete Role']))
                    <div class="table-responsive">
                        <table id="usersDatatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @else
                    <div class="access-denied-main">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/admin/img/access-denied.png') }}" alt="">
                                <h4 class="text-muted">You don't have permission to view roles</h4>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
