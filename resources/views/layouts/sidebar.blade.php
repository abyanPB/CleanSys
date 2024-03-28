<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Provice<span>Group</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  @if (Auth::user()->level == 'admin')
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Utama</li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laporan</li>
            <a href="{{ route('laporan-grooming.index') }}" class="nav-link @if(request()->routeIs('laporan-grooming.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Grooming</span>
            </a>
            <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">PJKP</span>
            </a>
        </li>
        <li class="nav-item nav-category">Kelola</li>
        <a href="{{ route('user.index') }}" class="nav-link @if(request()->routeIs('user.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Pengguna</span>
            </a>
            <a href="{{ route('area.index') }}" class="nav-link @if(request()->routeIs('area.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Area Kerja</span>
            </a>
            <a href="{{ route('sop.index') }}" class="nav-link @if(request()->routeIs('sop.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">SOP</span>
            </a>
        </li>
    </div>
  @elseif (Auth::user()->level == 'spv')
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Utama</li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laporan</li>
            <a href="{{ route('showTanggapanGrooming') }}" class="nav-link @if(request()->routeIs('showTanggapanGrooming')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Grooming</span>
            </a>
            <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">PJKP</span>
            </a>
        </li>
    </div>
  @elseif (Auth::user()->level == 'cleaner')
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Utama</li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laporan</li>
            <a href="{{ route('laporan-grooming.index') }}" class="nav-link @if(request()->routeIs('laporan-grooming.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Grooming</span>
            </a>
            <a href="{{ url('/dashboard') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">PJKP</span>
            </a>
        </li>
        <li class="nav-item nav-category">Kelola</li>
        <a href="{{ route('user.index') }}" class="nav-link @if(request()->routeIs('user.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Pengguna</span>
            </a>
            <a href="{{ route('area.index') }}" class="nav-link @if(request()->routeIs('area.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Area Kerja</span>
            </a>
            <a href="{{ route('sop.index') }}" class="nav-link @if(request()->routeIs('sop.index')) active_class @endif">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">SOP</span>
            </a>
        </li>
    </div>
  @endif
</nav>
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted">Sidebar:</h6>
    <div class="form-group border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
    <div class="theme-wrapper">
      <h6 class="text-muted mb-2">Light Version:</h6>
      <a class="theme-item active" href="https://www.nobleui.com/laravel/template/light/">
        <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
      </a>
      <h6 class="text-muted mb-2">Dark Version:</h6>
      <a class="theme-item" href="https://www.nobleui.com/laravel/template/dark">
        <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
      </a>
    </div>
  </div>
</nav>
