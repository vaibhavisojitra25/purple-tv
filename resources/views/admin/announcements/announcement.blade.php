@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/announcement/announcement.js"></script>
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
<script>
    var tableData;
</script>
@if(Auth::user()->hasRole('SuperAdmin'))
<script>
    var tableData = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('announcement.index')}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'title', name: 'title', sClass: "align-middle table-image"},
            {data: 'short_description', name: 'short_description', sClass: "align-middle"},
            {data: 'image', name: 'image', sClass: "align-middle", orderable: false, searchable: false},
            {data: 'status', name: 'status', sClass: "align-middle"},
            {data: 'action', name: 'action', orderable: false, searchable: false, sClass: "align-middle no-wrap"},
        ],
        // responsive: true
    });
</script>
@endif
@can('Add Announcement')
<script>
    $('#announcementForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        if ($(this).valid()) {
            $.ajax({
                url: '{{route("announcement.store")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $("#announcementForm")[0].reset();
                        $(".custom-file-label").removeClass("selected").html('');
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
<script>
    function updateStatus(id) {
        notie.confirm({
            text: 'Are you sure you want to change status?',
            submitText: 'Yes',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    data: {id: id},
                    url: "{{ route('changeAnnouncementStatus') }}",
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
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Announcement</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Announcement</li>
        </ol>
    </div>
    <div class="row">
        @can('Add Announcement')
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6>New Announcement</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="announcementForm" novalidate enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="title">Title *</label>
                                <input type="text" id="title" name="title" placeholder="Title" class="form-control"
                                    required>
                            </div>
                            <div class="form-group col-12">
                                <label for="shortDesc">Short Description *</label>
                                <textarea name="short_description" id="shortDesc" rows="5"
                                    placeholder="Short Description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group col-12">
                                <p class="mb-2">Image <small>(Optional)</small></p>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <p class="mb-2">Status</p>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" id="on" value="1" name="status" class="custom-control-input"
                                        checked>
                                    <label for="on" class="custom-control-label">On</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block ml-4">
                                    <input type="radio" id="off" value="0" name="status" class="custom-control-input">
                                    <label for="off" class="custom-control-label">Off</label>
                                </div>
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
        @can('View Announcement')
        <div class="col-12 @can('Add Announcement') {{ 'col-md-8' }} @endcan">
            <div class="card">
                <div class="card-header">
                    <h6>Announcement</h6>
                </div>
                <div class="card-body">
                    @if(Auth::user()->hasRole('SuperAdmin'))
                    <div class="table-responsive">
                        <table id="announcements-datatable" class="table datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th width="30%">Short Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @else
                    <div class="row">
                        @php
                        $total = sizeof($announcements);
                        $i = 0;
                        @endphp
                        @if($total > 0)
                            @foreach ($announcements as $item)
                            @php
                            $i += 1;
                            @endphp
                            <div class="col-12">
                                <div class="alert mb-0 alert-dark" role="alert">
                                    <div class="row">
                                        @if($item->image)
                                        <div class="col-2 col-md-1">
                                            <img src="{{ url('/uploads/announcements/', $item->image) }}" class="w-100"
                                                alt="">
                                        </div>
                                        @endif
                                        <div class="@if($item->image) {{ 'col-10 col-md-11' }} @else {{ 'col-12' }} @endif">
                                            <h4 class="alert-heading mb-1">{{ $item->title }}</h4>
                                            <p class="text-muted mb-0"> <i class="icon-fa icon-fa-clock-o"></i> {{ date('d/m/Y h:i a', strtotime($item->created_at)) }}</p>
                                            <hr>
                                            <p class="mb-0">{{ $item->short_description }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if($i < $total) <hr>@endif
                            </div>
                            @endforeach
                        @else
                        <div class="col-12">
                            <p class="text-muted text-center">No Announcements</p>
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