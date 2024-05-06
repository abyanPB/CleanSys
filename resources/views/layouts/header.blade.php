<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <ul class="navbar-nav">
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if (request()->user()->image == null)
                <img src="{{ url('https://ui-avatars.com/api/?name='.request()->user()->name)}}" alt="">
            @else
                <img src="{{asset('images/pengguna/'.request()->user()->image)}}" alt="Foto Pengguna">
            @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
                @if (request()->user()->image == null)
                    <img src="{{ url('https://ui-avatars.com/api/?name='.request()->user()->name)}}" alt="">
                @else
                    <img src="{{ url('https://ui-avatars.com/api/?name='.request()->user()->name)}}" alt="">
                @endif
            </div>
            <div class="info text-center">
              <p class="name font-weight-bold mb-0">{{request()->user()->name}}</p>
              <p class="email text-muted mb-3">{{request()->user()->email}}</p>
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
            @if(request()->user()->default_pass == 1)
                <li class="nav-item">
                    <a href="{{ route('showProfile') }}" class="nav-link">
                    <i data-feather="user"></i>
                    <span>Profile</span>
                    </a>
                </li>
            @endif
              <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span>Log Out</span>
              </a>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>
