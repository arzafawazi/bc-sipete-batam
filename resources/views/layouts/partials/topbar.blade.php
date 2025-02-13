<!-- Topbar Start -->
<style>
  .topbar-custom {
    background: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
  }

  .topbar-custom .nav-link,
  .topbar-custom .pro-user-name {
    color: #001B2F !important;
  }

  .topbar-custom .nav-link:hover {
    color: #2786F1 !important;
  }

  .topbar-custom .dropdown-item:hover {
    background: #2786F1;
    color: white;
  }
</style>

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
            <h5 class="mb-0 text-white">Selamat Datang {{ ucwords(Auth::user()->name) }}</h5>
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
