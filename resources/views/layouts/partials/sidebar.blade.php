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
                <a class="nav-link tambahan" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-{{ $menu->id }}" aria-expanded="false" aria-controls="submenu-{{ $menu->id }}">
                  @if ($menu->icon)
                    <i data-feather="{{ $menu->icon }}"></i>
                  @endif
                  <span>{{ $menu->uraian_menu }}</span>
                  @if ($menu->subMenus->isNotEmpty())
                    <span class="menu-arrow"></span>
                  @endif
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
                <a class="nav-link tambahan" href="{{ url($menu->fd) }}">
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
  .tambahan {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 0.85rem 1.2rem !important;
  }

  .nav-link i {
    min-width: 20px !important;
    /* Memastikan icon memiliki lebar tetap */
    display: flex !important;
    justify-content: center !important;
  }


  .menu-arrow {
    margin-left: auto !important;
    /* Mendorong arrow ke kanan */
  }

  /* Memastikan teks menu sejajar */
  .nav-link {
    position: relative !important;
  }

  .nav-link i+span,
  .nav-link span:first-child {
    padding-left: 20px !important;
    /* Jarak seragam untuk menu tanpa icon */
  }

  .nav-link i~span {
    padding-left: 0 !important;
  }

  body[data-sidebar="hidden"] .logo-box {
    opacity: 0;
    visibility: hidden;
    height: 0;
    margin: 0;
    padding: 0;
  }



  body[data-sidebar="default"] .logo-box {
    height: 0;
    margin: 0;
    padding: 0;
    transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .logo-box {
    opacity: 1;
    visibility: visible;
    height: auto;
  }


  body[data-sidebar="hidden"] .logo-box .logo {
    opacity: 0;
  }

  .logo-box {
    padding: 0 !important;
  }

  .satu {
    display: block;
    margin: 0 auto;
    height: 15px;
    width: 75px;
  }

  .menu-title {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    background: linear-gradient(45deg, #3699ff, #5d6cc3);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    padding: 1.2rem 1.5rem;
    margin-top: 1rem;
    position: relative;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
  }

  .menu-title::after {
    content: '';
    position: absolute;
    left: 1.5rem;
    bottom: 0.8rem;
    width: 30px;
    height: 2px;
    background: linear-gradient(90deg, #3699ff, transparent);
  }

  .nav-item {
    margin: 0.4rem 0;
    position: relative;
    perspective: 1000px;
  }

  .nav-link {
    border-radius: 12px;
    margin: 0 1rem;
    padding: 0.85rem 1.2rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    background: rgba(255, 255, 255, 0.01);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.05);
    overflow: hidden;

  }


  .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(54, 153, 255, 0.03), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
  }

  .nav-link:hover {
    transform: translateX(5px) translateZ(20px);
    background: rgba(54, 153, 255, 0.08);
    box-shadow:
      0 5px 15px rgba(54, 153, 255, 0.1),
      0 0 0 1px rgba(54, 153, 255, 0.05);
  }

  .nav-link:hover::before {
    transform: translateX(100%);
  }

  .nav-link i {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    z-index: 1;
  }

  .nav-link:hover i {
    transform: scale(1.2) rotate(360deg);
    color: #3699ff;
    filter: drop-shadow(0 0 8px rgba(54, 153, 255, 0.5));
  }

  .nav-second-level {
    padding-left: 3rem;
    position: relative;
    margin-top: 0.5rem;
  }

  .nav-second-level::before {
    content: '';
    position: absolute;
    left: 2rem;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(180deg,
        #3699ff 0%,
        rgba(54, 153, 255, 0.5) 50%,
        rgba(54, 153, 255, 0.1) 100%);
    box-shadow: 0 0 10px rgba(54, 153, 255, 0.3);
    animation: pulseLight 2s infinite;
  }

  @keyframes pulseLight {
    0% {
      opacity: 0.5;
    }

    50% {
      opacity: 1;
    }

    100% {
      opacity: 0.5;
    }
  }

  .nav-second-level li {
    position: relative;
    padding: 0.6rem 0;
  }

  .nav-second-level li::before {
    content: '';
    position: absolute;
    left: -1rem;
    top: 50%;
    width: 12px;
    height: 2px;
    background: #3699ff;
    transform-origin: left;
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  .nav-second-level li:hover::before {
    transform: scaleX(1);
  }

  .tp-link {
    position: relative;
    padding: 0.6rem 1.2rem;
    color: #6c757d;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
    border-radius: 8px;
    background: transparent;
    z-index: 1;
  }

  .tp-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #3699ff;
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 0 15px rgba(54, 153, 255, 0.5);
  }

  .tp-link::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(54, 153, 255, 0.03));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
    border-radius: 8px;
  }

  .tp-link:hover {
    color: #3699ff;
    padding-left: 2rem;
    text-shadow: 0 0 20px rgba(54, 153, 255, 0.5);
  }

  .tp-link:hover::before {
    opacity: 1;
    left: 0.8rem;
    transform: translateY(-50%) scale(1.2);
  }

  .tp-link:hover::after {
    transform: scaleX(1);
  }

  .menu-arrow {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  [aria-expanded="true"] .menu-arrow {
    transform: rotate(90deg) scale(1.2);
    color: #3699ff;
  }

  .collapse {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  [data-simplebar]::-webkit-scrollbar {
    width: 8px;
  }

  [data-simplebar]::-webkit-scrollbar-track {
    background: rgba(54, 153, 255, 0.05);
    border-radius: 4px;
  }

  [data-simplebar]::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #3699ff, #5d6cc3);
    border-radius: 4px;
    border: 2px solid transparent;
    background-clip: content-box;
  }

  [data-simplebar]::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #5d6cc3, #3699ff);
    border: 2px solid transparent;
    background-clip: content-box;
  }


  .app-sidebar-menu:hover {
    box-shadow:
      0 0 30px rgba(54, 153, 255, 0.1),
      0 0 60px rgba(54, 153, 255, 0.05);
  }

  @keyframes gradientWave {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }
</style>
