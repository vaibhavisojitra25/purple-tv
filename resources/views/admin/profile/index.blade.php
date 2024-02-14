@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/profile/profile.js"></script>
<script>
    function deleteConfirmation() {
        notie.confirm({
            text: 'Are you sure you want to delete?',
            submitText: 'Yes Delete It!',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _method: 'DELETE'
                    },
                    url: '{{ route("deleteAccount", $user->id) }}',
                    success: function (data) {
                        if(data.success) {
                            toastr.success(data.message);
                            setTimeout(function () {
                                window.location.reload();
                            }, 500);
                        }
                    },
                    error: function (data) {
                        toastr.error('Something went wrong');
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
        <h3 class="page-title">Profile</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    @if (!empty($user->profile_picture))
                    <img src="{{ url('/uploads/profile_pictures/', $user->profile_picture) }}" id="previewImg" alt="">
                    @else
                    <img src="{{asset('/assets/admin/img/avatars/avatar.png')}}" id="previewImg" alt="">
                    @endif
                    <div class="d-inline-block ml-4">
                        <h4 class="mb-0">{{ $user->full_name }}</h4>
                        @php
                            $roles = $user->roles->pluck('name')->toArray();
                        @endphp
                        @if(sizeof($roles) > 0)
                        <p class="mb-0 text-muted">{{ $roles[0] }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h6>Profile</h6>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tr>
                                <th scope="row" class="no-border">Full Name :-</th>
                                <td class="no-border">{{ $user->full_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Company Name :-</th>
                                <td>{{ $user->company_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email :-</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Mobile No :-</th>
                                <td>{{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Country :-</th>
                                <td>{{ $user->country }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Username :-</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                        </table>
                    </div>
                    <hr class="mt-0">
                    <button class="btn btn-danger" onclick="deleteConfirmation({{ $user->id }});">Delete
                        Account</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-header">
                    <h6>Update Profile</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('updateProfile', $user->id)}}" id="profileForm"
                        enctype="multipart/form-data" novalidate>
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <p class="mb-2">Profile Picture <small>(Optional)</small></p>
                                <div class="custom-file">
                                    <input type="file" name="profile_picture" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="fullName">Full Name *</label>
                                <input type="text" id="fullName" name="full_name" class="form-control"
                                    value="{{ $user->full_name }}" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="phoneNumber">Phone Number *</label>
                                <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                    value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="country">Country *</label>
                                <select name="country" id="country" class="form-control ls-select2" required>
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country }}" @if ($country==$user->country) {{'selected'}} @endif>
                                        {{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="curpassword">Current Password</label>
                                <input type="password" name="current_password" id="curpassword" class="form-control"
                                    autocomplete="new-password">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="new_password" id="newPassword" class="form-control"
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <hr class="mt-0">
                        <button class="btn btn-primary mr-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop