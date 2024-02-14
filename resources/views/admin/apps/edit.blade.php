@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/apps/apps.js"></script>
<script src="/assets/admin/js/confirmation/deleteconfirmation.js"></script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Apps</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.index')}}">Apps</a></li>
            <li class="breadcrumb-item active">Edit App</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6>Configure App</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('apps.update', $app->id)}}" id="appEditForm"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="appName">App Name *</label>
                                <input type="text" id="appName" name="app_name" class="form-control"
                                    value="{{ $app->app_name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="packageName">App Package Name *</label>
                                <input type="text" id="packageName" name="package_name" class="form-control"
                                    value="{{ $app->package_name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <p class="mb-2">App Type</p>
                                <div class="custom-control custom-checkbox d-inline-block">
                                    <input type="checkbox" id="android" value="Android" name="app_type[]"
                                        class="custom-control-input" @if(str_contains($app->app_type, 'Android'))
                                    {{ 'checked' }} @endif>
                                    <label for="android" class="custom-control-label">Android</label>
                                </div>
                                <div class="custom-control custom-checkbox d-inline-block ml-4">
                                    <input type="checkbox" id="ios" value="Ios" name="app_type[]"
                                        class="custom-control-input" @if(str_contains($app->app_type, 'Ios'))
                                    {{ 'checked' }} @endif>
                                    <label for="ios" class="custom-control-label">Ios</label>
                                </div>
                                <div class="custom-control custom-checkbox d-inline-block ml-4">
                                    <input type="checkbox" id="roku" value="Roku" name="app_type[]"
                                        class="custom-control-input" @if(str_contains($app->app_type, 'Roku'))
                                    {{ 'checked' }} @endif>
                                    <label for="roku" class="custom-control-label">Roku</label>
                                </div>
                            </div>
                            @if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']))
                            <div class="form-group col-12">
                                <label for="appMode">App Mode *</label>
                                <select name="app_mode" id="appMode" class="form-control">
                                    <option value="">Select Mode</option>
                                    <option value="CodeLogin" @if($app->app_mode == 'CodeLogin') {{ 'selected' }} @endif>CodeLogin</option>
                                    <option value="Xstream" @if($app->app_mode == 'Xstream') {{ 'selected' }} @endif>Xstream</option>
                                    <option value="Universal" @if($app->app_mode == 'Universal') {{ 'selected' }} @endif>Universal</option>
                                </select>
                            </div>
                            <div class="form-group col-12 @if($app->app_mode != 'Universal') {{ 'd-none' }} @endif" id="appModeUniversal">
                                <label for="appModeUni">App Mode Universal *</label>
                                <input type="text" id="appModeUni" name="app_mode_universal" class="form-control" value="{{ $app->app_mode_universal }}">
                            </div>
                            @endif
                            <div class="form-group col-12">
                                <p class="mb-2">App Icon *</p>
                                <div class="custom-file">
                                    <input type="file" name="app_icon" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose Icon</label>
                                </div>
                                <div class="pt-2">
                                    <img src="{{ url('/uploads/apps/', $app->app_icon) }}" id="viewImg" width="50px" alt="">
                                </div>
                            </div>
                            @if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']))
                            <div class="form-group col-12">
                                <p class="mb-2">Status</p>
                                <div class="custom-control custom-radio d-inline-block">
                                    <input type="radio" id="on" value="1" name="status" class="custom-control-input" @if($app->status == 1) {{ 'checked' }} @endif>
                                    <label for="on" class="custom-control-label">On</label>
                                </div>
                                <div class="custom-control custom-radio d-inline-block ml-4">
                                    <input type="radio" id="off" value="0" name="status" class="custom-control-input" @if($app->status == 0) {{ 'checked' }} @endif>
                                    <label for="off" class="custom-control-label">Off</label>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success mr-2">Save</button>
                            <a href="{{ route('apps.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop