@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/users/users.js"></script>
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
    </div>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Update User</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('users.update', $user->id)}}" id="userForm" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12 col-lg-4">
                                <label for="fullName">Full Name *</label>
                                <input type="text" id="fullName" name="full_name" class="form-control"
                                    value="{{ $user->full_name }}" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" readonly class="form-control"
                                    value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="phoneNumber">Phone Number *</label>
                                <input type="text" id="phoneNumber" name="phone_number" class="form-control"
                                    value="{{ $user->phone_number }}" required>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="userName">Username *</label>
                                <input type="text" id="userName" name="username" readonly class="form-control"
                                    value="{{ $user->username }}" disabled>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="userRole">Role *</label>
                                <select name="role" id="userRole" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @if(in_array($role->name,
                                        $user->roles->pluck('name')->toArray())) {{ 'selected' }}
                                        @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="skypeId">Skype ID</label>
                                <input type="text" id="skypeId" name="skype_id" class="form-control"
                                    value="{{ $user->skype_id }}">
                            </div>
                            <div class="form-group col-12 col-lg-4">
                                <label for="telegramId">Telegram ID</label>
                                <input type="text" id="telegramId" name="telegram_id" class="form-control"
                                    value="{{ $user->telegram_id }}">
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success mr-2">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop