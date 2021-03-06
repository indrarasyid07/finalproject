<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('welcome')}}" class="nav-link">Beranda</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('about')}}" class="nav-link">Tentang Kami</a>
        </li>
    </ul>
    
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="{{route('pertanyaan.search')}}" method="POST">
        @csrf
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="katakunci" type="search" placeholder="Cari Pertanyaan" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                {{Auth::user()->name}}
                <i class="far fa-user"></i>
                <span class="badge badge-warning navbar-badge">{{Auth::user()->reputation}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <a href="#" class="dropdown-item">
                    <center>
                        <i class="fas fa-star mr-2"></i> Reputasi ({{Auth::user()->reputation}})
                    </center>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </li>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-primary btn-sm"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a style="color:white" href="{{ route('register') }}" class="btn btn-warning btn-sm ml-2"><i class="fas fa-file-contract"></i> Register</a>
    @endif
</ul>
</nav>