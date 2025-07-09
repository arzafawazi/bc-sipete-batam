<div class="topbar-custom">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
      <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
        <li>
          <button class="button-toggle-menu nav-link">
            <i data-feather="menu" class="noti-icon"></i>
          </button>
        </li>
        <li class="d-none d-lg-block">
          @if (Auth::check())
            <div class="system-container">
              <div class="system-wrapper">
                <div class="corner-accent top-right"></div>
                <div class="corner-accent bottom-left"></div>
                <div class="light-sweep"></div>
                <div class="glow-effect"></div>
                <div class="border-line"></div>
                
                <h5 class="system-title">
                  {{-- <div class="system-icon-wrapper">
                    <i data-feather="shield" class="system-icon"></i>
                  </div> --}}
                  <span class="highlight">
                    <span class="highlight-letter">S</span><span class="highlight-letter">I</span>
                  </span>STEM<span class="word-spacer"></span>
                  <span class="highlight">
                    <span class="highlight-letter">P</span><span class="highlight-letter">E</span>
                  </span>NGAWASAN<span class="word-spacer"></span>
                  <span class="highlight">
                    <span class="highlight-letter">T</span><span class="highlight-letter">E</span>
                  </span>RPADU
                </h5>
              </div>
            </div>
          @endif
        </li>
      </ul>
      <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
        <li class="d-none d-sm-flex">
          <button type="button" class="btn nav-link" data-toggle="fullscreen">
            <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
          </button>
        </li>
        <li class="dropdown notification-list topbar-dropdown">
          <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <span data-feather="user" class="fa-3x rounded-circle bg-light text-primary"></span>
            <span class="pro-user-name ms-1">
              {{ ucwords(Auth::user()->name) }} <i class="mdi mdi-chevron-down"></i>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-end profile-dropdown">
            <a href="{{ route('password.reset') }}" class="dropdown-item notify-item">
              <i class="mdi mdi-key fs-16 align-middle"></i>
              <span>Reset Password</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item notify-item">
                <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                <span>Logout</span>
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- end Topbar -->

<link rel="stylesheet" href="{{ asset('css/topbar.css') }}">