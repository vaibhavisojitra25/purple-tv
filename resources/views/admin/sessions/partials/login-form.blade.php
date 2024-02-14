<h3 class="text-white mb-2">Sign In</h3>
<p class="text-white mb-4">Login in to your admin account</p>
<form action="{{route('login.post')}}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
    </div>

    <div class="other-actions row mb-4">
        <div class="col-12 text-right">
            <a href="{{route('forgot-password.index')}}" class="forgot-link">Forgot password?</a>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div>
    </div>
    <button class="btn btn-theme btn-full">Login</button>
</form>