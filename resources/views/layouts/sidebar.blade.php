@if(Auth::check())
    @if (Auth::user()->default_pass == 1)
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
                        <li class="nav-item {{ active_class(['Dashboard']) }}">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="home"></i>
                            <span class="link-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Laporan</li>
                        <li class="nav-item {{ active_class(['Admin/Laporan-Grooming*']) }}">
                            <a href="{{ route('laporan-grooming.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="file-plus"></i>
                            <span class="link-title">Grooming</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_class(['Admin/Laporan-PJKP*']) }}">
                            <a href="{{ route('laporan-pjkp.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="folder-plus"></i>
                            <span class="link-title">PJKP</span>
                            </a>
                        </li>
                        <li class="nav-item nav-category">Kelola</li>
                        <li class="nav-item {{ active_class(['Admin/User*']) }}">
                            <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="users"></i>
                            <span class="link-title">Pengguna</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_class(['Admin/Area*']) }}">
                            <a href="{{ route('area.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="map-pin"></i>
                            <span class="link-title">Area Kerja</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_class(['Admin/Sop*']) }}">
                            <a href="{{ route('sop.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="activity"></i>
                            <span class="link-title">SOP</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @elseif (Auth::user()->level == 'spv')
                <div class="sidebar-body">
                    <ul class="nav">
                    <li class="nav-item nav-category">Menu</li>
                    <li class="nav-item {{ active_class(['Dashboard']) }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="home"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_class(['Supervisor/Laporan-Grooming*']) }}">
                        <a href="{{ route('showTanggapanGrooming') }}" class="nav-link">
                            <i class="link-icon" data-feather="file-plus"></i>
                            <span class="link-title">Grooming</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_class(['Supervisor/Laporan-PJKP*']) }}">
                        <a href="{{ route('showTanggapanPjkp') }}" class="nav-link">
                            <i class="link-icon" data-feather="folder-plus"></i>
                            <span class="link-title">PJKP</span>
                        </a>
                    </li>
                </div>
            @elseif (Auth::user()->level == 'cleaner')
                <div class="sidebar-body">
                    <ul class="nav">
                    <li class="nav-item nav-category">Menu</li>
                    <li class="nav-item {{ active_class(['Dashboard']) }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="home"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_class(['Cleaner/Laporan-Grooming*']) }}">
                        <a href="{{ route('showLaporanGroomingCleaner') }}" class="nav-link">
                            <i class="link-icon" data-feather="file-plus"></i>
                            <span class="link-title">Grooming</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_class(['Cleaner/Laporan-PJKP*']) }}">
                        <a href="{{ route('showLaporanPjkpCleaner') }}" class="nav-link">
                            <i class="link-icon" data-feather="folder-plus"></i>
                            <span class="link-title">PJKP</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active_class(['Cleaner/Sop*']) }}">
                        <a href="{{ route('showSopCleaner') }}" class="nav-link">
                            <i class="link-icon" data-feather="activity"></i>
                            <span class="link-title">SOP</span>
                        </a>
                    </li>
                </div>
            @endif
            </nav>

    @elseif(Auth::user()->default_pass == 0)
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
@else

@endif
