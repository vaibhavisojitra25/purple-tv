@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/notification/notification.js"></script>
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
<script>
    var tableData;
</script>
@if(Auth::user()->hasRole('SuperAdmin'))
<script>
    tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('notification.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'title', name: 'title', sClass: "align-middle table-image"},
            {data: 'message', name: 'message', sClass: "align-middle"},
            {data: 'image', name: 'image', sClass: "align-middle", orderable: false, searchable: false},
            {data: 'external_link', name: 'external_link', sClass: "align-middle"},
            // {data: 'sent_users', name: 'sent_users', sClass: "align-middle"},
            // {data: 'received_users', name: 'received_users', sClass: "align-middle"},
            // {data: 'click_users', name: 'click_users', sClass: "align-middle"},
            {data: 'action', name: 'action', orderable: false, searchable: false, sClass: "align-middle no-wrap"},
        ],
        // responsive: true
    });
</script>
@endif
@can('Send Notification')
<script>
    $('#notificationForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        if ($(this).valid()) {
            $.ajax({
                url: '{{route("notification.store")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $("#notificationForm")[0].reset();
                        $(".custom-file-label").removeClass("selected").html('')
                        validateForm.resetForm();
                        if(tableData) {
                            tableData.ajax.reload();
                        }
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function (error) {
                    toastr.error('Something went wrong.');
                }
            });
        }
    });
</script>
@endcan
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Notification</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Notification</li>
        </ol>
    </div>
    <div class="row">
        @can('Send Notification')
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6>Send Notification</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="notificationForm" novalidate enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="title">Title *</label>
                                <input type="text" id="title" name="title" placeholder="Title" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-12">
                                <label for="message">Message *</label>
                                <textarea name="message" id="message" rows="5" placeholder="Notification Message"
                                    class="form-control" required></textarea>
                            </div>
                            <div class="form-group col-12">
                                <p class="mb-2">Image <small>(Optional)</small></p>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="externalLink">External Link <small>(Optional)</small></label>
                                <input type="text" id="externalLink" name="external_link" placeholder="External Link"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
        @can('View Notification')
        <div class="col-12 @can('Send Notification') {{ 'col-md-8' }} @endcan">
            <div class="card">
                <div class="card-header">
                    <h6>Notifications</h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('SuperAdmin'))
                    <div class="table-responsive">
                        <table id="notifications-datatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th width="30%">Message</th>
                                    <th>Image</th>
                                    <th>External Link</th>
                                    {{-- <th>Sent Users</th>
                                    <th>Received Users</th>
                                    <th>Click Users</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @else
                    <div class="row">
                        @php
                        $total = sizeof($notifications);
                        $i = 0;
                        @endphp
                        @if($total > 0)
                            @foreach ($notifications as $item)
                            @php
                            $i += 1;
                            @endphp
                            <div class="col-12">
                                <div class="alert mb-0 alert-dark" role="alert">
                                    <div class="row">
                                        @if($item->image)
                                        <div class="col-2 col-md-1">
                                            <img src="{{ url('/uploads/notifications/', $item->image) }}" class="w-100"
                                                alt="">
                                        </div>
                                        @endif
                                        <div class="@if($item->image) {{ 'col-10 col-md-11' }} @else {{ 'col-12' }} @endif">
                                            <h4 class="alert-heading mb-1">{{ $item->title }}</h4>
                                            <p class="text-muted mb-0"> <i class="icon-fa icon-fa-clock-o"></i> {{ date('d/m/Y h:i a', strtotime($item->created_at)) }}</p>
                                            <hr>
                                            <p class="mb-0">{{ $item->message }}</p>
                                            @if($item->external_link)
                                            <a href="{{ $item->external_link }}" class="alert-link" target="_blank">{{ $item->external_link }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($i < $total) <hr>@endif
                            </div>
                            @endforeach
                        @else
                        <div class="col-12">
                            <p class="text-muted text-center">No Notification</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>
@stop