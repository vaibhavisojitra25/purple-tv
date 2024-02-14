@extends('admin.layouts.layout-basic')

@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <div class="access-denied-main">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/admin/img/access-denied.png') }}" alt="">
                        <h4 class="text-muted">You don't have permission for this.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop