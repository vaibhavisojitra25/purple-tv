@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/vpn/vpn.js"></script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">VPN</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('vpns.index')}}">VPN</a></li>
            <li class="breadcrumb-item active">Edit VPN</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Edit VPN</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('vpns.update', $vpn->id)}}" id="vpnForm"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="country">Country *</label>
                                <select name="country" id="country" class="form-control ls-select2" required>
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                    <option value="{{ $country }}" @if ($country==$vpn->country) {{'selected'}} @endif>
                                        {{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="city">City *</label>
                                <input type="text" id="city" name="city" class="form-control" value="{{ $vpn->city }}"
                                    required>
                            </div>
                            <div class="form-group col-12">
                                <label for="fileUrl">File URL *</label>
                                <input type="text" id="fileUrl" name="file_url" class="form-control"
                                    value="{{ $vpn->file_url }}">
                            </div>
                            {{-- <div class="form-group col-12">
                                <p class="text-center mb-0">OR</p>
                                <p class="mb-2">File</p>
                                <div class="custom-file">
                                    <input type="file" name="vpn_file" class="custom-file-input" id="vpnFile">
                                    <label class="custom-file-label" for="vpnFile">Choose file</label>
                                </div>
                            </div> --}}
                            <div class="form-group col-12">
                                <hr class="mt-0">
                                <div class="d-vertical-center">
                                    <label class="mb-0 mr-2">Status</label>
                                    <input type="checkbox" name="status" class="ls-switch" @if($vpn->status == 1)
                                    {{ 'checked' }} @endif />
                                </div>
                                <hr class="mb-0">
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-success mr-2">Save</button>
                            <a href="{{ route('vpns.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop