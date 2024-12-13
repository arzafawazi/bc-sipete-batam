<!-- Left Sidebar Start -->
<div class="app-sidebar-menu shadow-lg">
  <div class="h-100" data-simplebar>
    <div id="sidebar-menu">

      <div class="logo-box mt-2">
        <a href="#" class="logo logo-light">
          <span class="logo-lg">
            <img src="/images/bc.png" alt="" height="65" width="250">
          </span>
        </a>
      </div>


      @php
        $displayedMenus = [];
      @endphp
      <hr class="satu">


      <ul id="side-menu">

        <li class="menu-title">Menu</li>

        @foreach ($menus as $menu)
          @if (!in_array($menu->kode, $displayedMenus))
            <li class="nav-item">
              @if ($menu->subMenus->isNotEmpty())
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-{{ $menu->id }}" aria-expanded="false" aria-controls="submenu-{{ $menu->id }}">
                  @if ($menu->icon)
                    <i data-feather="{{ $menu->icon }}"></i>
                  @endif
                  {{ $menu->uraian_menu }}
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="submenu-{{ $menu->id }}">
                  <ul class="nav-second-level">
                    @foreach ($menu->subMenus as $subMenu)
                      <li>
                        <a href="{{ url($subMenu->fd) }}" class="tp-link">{{ $subMenu->uraian_menu }}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              @else
                <a class="nav-link" href="{{ url($menu->fd) }}">
                  @if ($menu->icon)
                    <i data-feather="{{ $menu->icon }}"></i>
                  @endif
                  {{ $menu->uraian_menu }}
                </a>
              @endif
            </li>
            @php
              $displayedMenus[] = $menu->kode;
            @endphp
          @endif
        @endforeach

    </div>
    <div class="clearfix"></div>
  </div>
</div>

<style>
  .logo-box {
    padding: 0 !important;
  }

  .satu {
    display: block;
    margin: 0 auto;
    height: 15px;
    width: 75px;
  }
</style>
