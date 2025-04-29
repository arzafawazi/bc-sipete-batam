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
  
  /* Ultra-Premium System Title Styling */
  .system-container {
    margin-left: 15px;
    perspective: 1000px;
  }
  
  .system-wrapper {
    position: relative;
    padding: 12px 20px;
    border-radius: 8px;
    /*background: linear-gradient(135deg, #ffffff, #fcfcfc, #f7f7f7);
    box-shadow: 0 5px 20px rgba(0,0,0,0.05),
                0 2px 6px rgba(0,0,0,0.02),
                inset 0 1px 1px rgba(255,255,255,0.7);
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);*/
    cursor: default;
    /*border-left: 3px solid #287F71;*/
    overflow: hidden;
    transform-style: preserve-3d;
    backface-visibility: hidden;
  }
  
  .system-wrapper:hover {
    transform: translateY(-3px) rotateX(2deg) rotateY(-2deg) scale(1.02);
    box-shadow: 0 12px 30px rgba(40, 127, 113, 0.12),
                0 4px 8px rgba(0,0,0,0.05),
                inset 0 1px 1px rgba(255,255,255,0.9);
  }
  
  .system-title {
    font-size: 1.28rem;
    font-weight: 500;
    letter-spacing: 0.02em;
    margin: 0;
    display: flex;
    align-items: center;
    color: #2a2a2a;
    text-shadow: 0 1px 1px rgba(255,255,255,0.7);
    transition: all 0.4s ease;
  }
  
  .system-wrapper:hover .system-title {
    letter-spacing: 0.05em;
  }
  
  .highlight {
    color: #287F71;
    font-weight: 700;
    position: relative;
    display: inline-block;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 0 1px;
  }
  
  .system-wrapper:hover .highlight {
    color: #287F71;
    text-shadow: 0 0 15px rgba(40, 127, 113, 0.3);
    transform: translateY(-1px);
  }
  
  /* Ultra-modern layered underline effect */
  .highlight::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, 
                rgba(40, 127, 113, 0.2), 
                rgba(40, 127, 113, 0.8), 
                rgba(40, 127, 113, 0.2));
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1);
    z-index: 1;
  }
  
  .highlight::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 5%;
    width: 90%;
    height: 1px;
    background: linear-gradient(90deg, 
                transparent, 
                rgba(40, 127, 113, 0.3), 
                transparent);
    transform: scaleX(0);
    transform-origin: center;
    transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1) 0.1s;
    z-index: 0;
    opacity: 0.6;
  }
  
  .system-wrapper:hover .highlight::before {
    transform: scaleX(1);
  }
  
  .system-wrapper:hover .highlight::after {
    transform: scaleX(1);
  }
  
  .word-spacer {
    margin: 0 7px;
    position: relative;
    display: inline-block;
  }
  
  .system-icon-wrapper {
    position: relative;
    margin-right: 15px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: linear-gradient(135deg, #f5f5f5, #ffffff);
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    overflow: hidden;
  }
  
  .system-wrapper:hover .system-icon-wrapper {
    background: linear-gradient(135deg, rgba(40, 127, 113, 0.07), rgba(40, 127, 113, 0.01));
    box-shadow: 0 3px 10px rgba(40, 127, 113, 0.15);
    transform: rotate(7deg) scale(1.15);
  }
  
  .system-icon {
    color: #287F71;
    transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 2;
    filter: drop-shadow(0 2px 3px rgba(40, 127, 113, 0.2));
  }
  
  .system-wrapper:hover .system-icon {
    transform: rotate(360deg) scale(1.15);
    filter: drop-shadow(0 0 5px rgba(40, 127, 113, 0.5));
  }
  
  /* Premium light sweep effect */
  .light-sweep {
    position: absolute;
    top: 0;
    left: 0;
    width: 40px;
    height: 100%;
    background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.5), 
                transparent);
    transform: skewX(-20deg) translateX(-150px);
    opacity: 0;
    pointer-events: none;
  }
  
  .system-wrapper:hover .light-sweep {
    animation: lightSweep 2s ease-in-out infinite;
    opacity: 1;
  }
  
  @keyframes lightSweep {
    0% { transform: skewX(-20deg) translateX(-150px); }
    100% { transform: skewX(-20deg) translateX(400px); }
  }
  
  /* Advanced backdrop glow */
  .glow-effect {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 50% 50%, 
                rgba(40, 127, 113, 0.08), 
                transparent 70%);
    opacity: 0;
    transition: opacity 0.8s ease;
    pointer-events: none;
    mix-blend-mode: soft-light;
  }
  
  .system-wrapper:hover .glow-effect {
    opacity: 1;
  }
  
  /* Interactive letter highlight */
  .highlight-letter {
    display: inline-block;
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
  }
  
  .system-wrapper:hover .highlight-letter:first-child {
    animation: letterPulse 2s ease-in-out infinite;
  }
  
  .system-wrapper:hover .highlight-letter:last-child {
    animation: letterPulse 2s ease-in-out 0.3s infinite;
  }
  
  @keyframes letterPulse {
    0%, 100% { text-shadow: 0 0 8px rgba(40, 127, 113, 0.2); }
    50% { text-shadow: 0 0 15px rgba(40, 127, 113, 0.5); }
  }
  
  /* Bottom border animation */
  .border-line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #287F71, transparent);
    transform: scaleX(0);
    transition: transform 0.5s cubic-bezier(0.77, 0, 0.175, 1);
  }
  
  .system-wrapper:hover .border-line {
    transform: scaleX(1);
  }
  
  /* Advanced elements */
  .corner-accent {
    position: absolute;
    width: 6px;
    height: 6px;
    border-radius: 1px;
    background-color: rgba(40, 127, 113, 0.7);
    opacity: 0;
    transition: all 0.5s ease;
  }
  
  .corner-accent.top-right {
    top: 5px;
    right: 5px;
    transform: translate(5px, -5px) rotate(45deg);
  }
  
  .corner-accent.bottom-left {
    bottom: 5px;
    left: 5px;
    transform: translate(-5px, 5px) rotate(45deg);
  }
  
  .system-wrapper:hover .corner-accent {
    opacity: 1;
    transform: translate(0, 0) rotate(45deg);
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