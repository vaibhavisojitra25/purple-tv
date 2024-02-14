@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/users/users.js"></script>
@if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Users', 'Edit Users', 'Delete Users']))
<script>
    var tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('users.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'full_name', name: 'full_name', sClass: "align-middle table-image"},
            {data: 'email', name: 'email', sClass: "align-middle"},
            {data: 'phone_number', name: 'phone_number', sClass: "align-middle"},
            {data: 'username', name: 'username', sClass: "align-middle"},
            {data: 'role', name: 'role', sClass: "align-middle", searchable: false},
            {data: 'status', name: 'status', sClass: "align-middle"},
            {data: 'created_at', name: 'created_at', sClass: "align-middle"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif

@can('Active Deactive Users')
<script>
    function updateStatus(id) {
        notie.confirm({
            text: 'Are you sure you want to change status?',
            submitText: 'Yes',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    data: {id: id},
                    url: "{{ route('changeUserStatus') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (response) {
                        toastr.success(response.message);
                        tableData.ajax.reload();
                    },
                    error: function (err) {
                        if(err.responseJSON.message) {
                            toastr.error(err.responseJSON.message);
                        } else {
                            toastr.error('Something went wrong');
                        }
                    }
                });
            }
        });
    }
</script>
@endcan
@can('Delete Users')
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
@endcan
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Users</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">User</li>
        </ol>
        @can('Create Users')
        <div class="page-actions">
            <a href="{{route('users.create')}}" class="btn btn-theme">
                <i class="icon-fa icon-fa-plus"></i> Add New User
            </a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>Users</h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View Users', 'Edit Users', 'Delete Users']))
                    <div class="table-responsive">
                        <table id="usersDatatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
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
                                <h4 class="text-muted">You don't have permission to view users</h4>
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