@if (request()->user()->default_pass == 1)
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
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Laporan</li>
        <li>
            <a href="{{ route('laporan-grooming.index') }}" class="nav-link @if(request()->routeIs('laporan-grooming.index')) active_class @endif">
            <i class="link-icon" data-feather="file-plus"></i>
            <span class="link-title">Grooming</span>
            </a>
            <a href="{{ route('laporan-pjkp.index') }}" class="nav-link @if(request()->routeIs('laporan-pjkp.index')) active_class @endif">
            <i class="link-icon" data-feather="folder-plus"></i>
            <span class="link-title">PJKP</span>
            </a>
        </li>
        <li class="nav-item nav-category">Kelola</li>
        <li>
            <a href="{{ route('user.index') }}" class="nav-link @if(request()->routeIs('user.index')) active_class @endif">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Pengguna</span>
            </a>
            <a href="{{ route('area.index') }}" class="nav-link @if(request()->routeIs('area.index')) active_class @endif">
            <i class="link-icon" data-feather="map-pin"></i>
            <span class="link-title">Area Kerja</span>
            </a>
            <a href="{{ route('sop.index') }}" class="nav-link @if(request()->routeIs('sop.index')) active_class @endif">
            <i class="link-icon" data-feather="activity"></i>
            <span class="link-title">SOP</span>
            </a>
        </li>
    </div>
  @elseif (Auth::user()->level == 'spv')
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Menu</li>
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
                <i class="link-icon" data-feather="home"></i>
                <span class="link-title">Dashboard</span>
            </a>
            <a href="{{ route('showTanggapanGrooming') }}" class="nav-link @if(request()->routeIs('showTanggapanGrooming')) active_class @endif">
                <i class="link-icon" data-feather="file-plus"></i>
                <span class="link-title">Grooming</span>
            </a>
            <a href="{{ route('showTanggapanPjkp') }}" class="nav-link @if(request()->routeIs('showTanggapanPjkp')) active_class @endif">
                <i class="link-icon" data-feather="folder-plus"></i>
                <span class="link-title">PJKP</span>
            </a>
        </li>
    </div>
  @elseif (Auth::user()->level == 'cleaner')
    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Menu</li>
        <li>
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
                <i class="link-icon" data-feather="home"></i>
                <span class="link-title">Dashboard</span>
            </a>
            <a href="{{ route('showLaporanGroomingCleaner') }}" class="nav-link @if(request()->routeIs('showLaporanGroomingCleaner')) active_class @endif">
                <i class="link-icon" data-feather="file-plus"></i>
                <span class="link-title">Grooming</span>
            </a>
            <a href="{{ route('showLaporanPjkpCleaner') }}" class="nav-link @if(request()->routeIs('showLaporanPjkpCleaner')) active_class @endif">
                <i class="link-icon" data-feather="folder-plus"></i>
                <span class="link-title">PJKP</span>
            </a>
            <a href="{{ route('showSopCleaner') }}" class="nav-link @if(request()->routeIs('showSopCleaner')) active_class @endif">
                <i class="link-icon" data-feather="activity"></i>
                <span class="link-title">SOP</span>
            </a>
        </li>
    </div>
  @endif
</nav>

@elseif(request()->user()->default_pass == 0)
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

    <div class="sidebar-body">
        <ul class="nav">
        <li class="nav-item nav-category">Utama</li>
            <a href="#" class="nav-link @if(request()->routeIs('dashboard')) active_class @endif">
            <i class="link-icon" data-feather="home"></i>
            <span class="link-title">Dashboard</span>
            </a>
        </li>
    </div>
</nav>
@endif
