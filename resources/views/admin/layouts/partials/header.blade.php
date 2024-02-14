<header class="site-header d-flex-between">
  <a href="#" class="nav-toggle">
    <div class="hamburger hamburger--htla">
      <span>toggle menu</span>
    </div>
  </a>
  <a href="{{route('dashboard')}}" class="brand-main">
    <img src="{{asset('/assets/admin/img/logo_wide.png')}}" id="logo-desk" alt="Purple Smart TV Logo"
      class="d-none d-md-inline ">
    <img src="{{asset('/assets/admin/img/logo_icon.png')}}" id="logo-mobile" alt="Purple Smart TV Logo"
      class="d-md-none">
    {{-- <span class="theme-logo pl-2" id="logo-desk" class="d-none d-md-inline">Purple Smart TV</span> --}}
  </a>

  <ul class="action-list">
    <li>
      <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="avatar">
        @if(isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
        <img src="{{url('uploads/profile_pictures', Auth::user()->profile_picture)}}" alt="Avatar">
        @else
        <img src="{{asset('/assets/admin/img/avatars/avatar.png')}}" alt="Avatar">
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right notification-dropdown">
        <a class="dropdown-item" href="/logout"><i class="icon-fa icon-fa-sign-out"></i> {{ __('trans.logout') }}</a>
      </div>
    </li>
  </ul>
</header>