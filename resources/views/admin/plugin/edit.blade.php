@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/plugin/plugin.js"></script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Plugin</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('plugins.index')}}">Plugin</a></li>
            <li class="breadcrumb-item active">Edit Plugin</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Edit Plugin</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('plugins.update', $plugin->id)}}" id="pluginForm" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="name">Name *</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $plugin->name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="packageName">Package Name *</label>
                                <input type="text" id="packageName" name="pkg_name" class="form-control"
                                    value="{{ $plugin->pkg_name }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="version">Version *</label>
                                <input type="text" id="version" name="version" class="form-control"
                                    value="{{ $plugin->version }}" required>
                            </div>
                            <div class="form-group col-12">
                                <label for="playStoreUrl">Play Store URL</label>
                                <input type="text" id="playStoreUrl" name="playstore_url" class="form-control"
                                    value="{{ $plugin->playstore_url }}">
                            </div>
                            <div class="form-group col-12">
                                <label for="apkUrl">APK URL</label>
                                <input type="text" id="apkUrl" name="apk_url" class="form-control"
                                    value="{{ $plugin->apk_url }}">
                            </div>
                            <div class="form-group col-12">
                                <hr class="mt-0">
                                <div class="d-vertical-center">
                                    <label class="mb-0 mr-2">Status</label>
                                    <input type="checkbox" name="status" class="ls-switch" @if($plugin->status == 1)
                                    {{ 'checked' }} @endif />
                                </div>
                                <hr class="mb-0">
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success mr-2">Save</button>
                            <a href="{{ route('plugins.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop