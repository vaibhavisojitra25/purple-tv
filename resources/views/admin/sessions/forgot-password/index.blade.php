@extends('admin.layouts.layout-login')

@section('scripts')
<script src="/assets/admin/js/sessions/login.js"></script>
@stop

@section('content')
<h3 class="text-white mb-2">Forgot Password?</h3>
<p class="text-white mb-4">Enter your email address and we ‘ll send you an email with instruction to reset your account
    password</p>
<form action="{{route('send-reset-link')}}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="email" class="form-control form-control-danger" placeholder="Enter email" name="email">
    </div>
    <button class="btn btn-theme btn-full">Recover Password</button>
</form>
<p class="text-center mt-4 mb-0">
    Back to <a href="{{ route('login') }}">Login</a>
</p>
@stop