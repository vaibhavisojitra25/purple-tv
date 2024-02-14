@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="/assets/admin/js/dashboard/dashboard.js"></script>
@stop

@section('content')
<div class="main-content" id="dashboardPage">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-0">
            <div class="dashbox">
                <span class="box-icon"><i class="icon-fa icon-fa-users"></i></span>
                <span class="desc">Total Users</span>
                <span class="title" id="totalOrders">{{ $totalUsers }}</span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-0">
            <div class="dashbox">
                <span class="box-icon"><i class="icon-fa icon-fa-user-plus"></i></span>
                <span class="desc">New Users</span>
                <span class="title" id="incompleteOrders">{{ $newUsers }}</span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-0">
            <div class="dashbox">
                <span class="box-icon"><i class="icon-fa icon-fa-mobile"></i></span>
                <span class="desc">Total Apps</span>
                <span class="title" id="totalOrders">{{ $totalApps }}</span>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 mb-md-0">
            <div class="dashbox">
                <span class="box-icon"><i class="icon-fa icon-fa-user"></i></span>
                <span class="desc">Total Admin</span>
                <span class="title" id="incompleteOrders">{{ $totalAdmin }}</span>
            </div>
        </div>
    </div>
</div>
@stop