<div class="logo-header">
    <a href="index.html" class="logo">
        DNY HIJAB SPORT
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
</div>
<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item dropdown d-none d-lg-flex">
                <a href="#" class="nav-link nav-btn">
                    <span class="btn btn-info btn-round">+ Buat Transaksi</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    @if(Auth::user()->photo)
                        @if(file_exists(public_path(). '/storage/user/'. Auth::user()->photo))
                            <img src="{{ asset('storage/user/'. Auth::user()->photo) }}" alt="user-img" width="30" height="30" class="img-circle">
                        @else
                            <img src="{{ asset('assets/images/nopic.jpg') }}" alt="user-img" width="30" height="30" class="img-circle"> 
                        @endif
                    @else
                        <img src="{{ asset('assets/images/nopic.jpg') }}" alt="user-img" width="30" height="30" class="img-circle">
                    @endif
                    <span>{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <div class="user-box">
                            <div class="u-text">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">Lihat Profil</a>
                            </div>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-user"></i> Profil Saya</a>
                    <a class="dropdown-item" href="#"><i class="ti-user"></i> Riwayat Akun</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="ti-settings"></i> Kembali ke Beranda</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        Keluar
                    </a>
                </ul>
            </li>
        </ul>
    </div>
</nav>