<!DOCTYPE html>
<html>

<head>
    <title>Purple Smart TV</title>
    <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.favicons')
</head>

<body class="login-page login-1">
    <div id="app" class="login-wrapper">
        <div class="login-box">
            @include('admin.layouts.partials.laraspace-notifs')
            <div class="logo-main">
                <a href="/" class="text-primary theme-logo">
                    <img src="/assets/admin/img/logo_wide.png" alt="Purple IPTV">
                </a>
            </div>
            @yield('content')
            <div class="page-copyright">
                <p>Copyright &copy; {{ date('Y') }} Purple Smart TV</p>
            </div>
        </div>
    </div>
    <script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
    <script src="{{mix('/assets/admin/js/core/app.js')}}"></script>
    @yield('scripts')
</body>

</html>