@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/vpn/vpn.js"></script>
@if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View VPN', 'Edit VPN', 'Delete VPN']))
<script>
    var tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('vpns.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'country', name: 'country', sClass: "align-middle table-image"},
            {data: 'city', name: 'city', sClass: "align-middle"},
            {data: 'file_url', name: 'file_url', sClass: "align-middle", orderable: false, searchable: false},
            {data: 'status', name: 'status', sClass: "align-middle"},
            {data: 'created_at', name: 'created_at', sClass: "align-middle"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif

@can('Edit VPN')
<script>
    function updateStatus(id) {
        notie.confirm({
            text: 'Are you sure you want to change status?',
            submitText: 'Yes',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    data: {id: id},
                    url: "{{ route('changeVpnStatus') }}",
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

@can('Delete VPN')
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
@endcan
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">VPN</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">VPN</li>
        </ol>
        @can('Create VPN')
        <div class="page-actions">
            <a href="{{route('vpns.create')}}" class="btn btn-theme">
                <i class="icon-fa icon-fa-plus"></i> Add New VPN
            </a>
        </div>
        @endcan
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>VPN List</h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasAnyPermission(['View VPN', 'Edit VPN', 'Delete VPN']))
                    <div class="table-responsive">
                        <table id="vpnDatatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>File</th>
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
                                <h4 class="text-muted">You don't have permission to view VPN</h4>
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