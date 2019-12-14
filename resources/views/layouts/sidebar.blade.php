<div class="scrollbar-inner sidebar-wrapper">
    <div class="user">
        <div class="photo">
            @if(Auth::user()->photo)
                @if(file_exists(public_path(). '/storage/user/'. Auth::user()->photo))
                    <img src="{{ asset('storage/user/'. Auth::user()->photo) }}" alt="user-img">
                @else
                    <img src="{{ asset('assets/images/nopic.jpg') }}" alt="user-img"> 
                @endif
            @else
                <img src="{{ asset('assets/images/nopic.jpg') }}" alt="user-img">
            @endif
        </div>
        <div class="info">
            <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                    {{ Auth::user()->name }}
                    <span class="user-level">{{ Auth::user()->role }}</span>
                    <span class="caret"></span>
                </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                <ul class="nav">
                    <li>
                        <a href="{{ route('user.profile', Auth::user()->id) }}">
                            <span class="link-collapse">Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <a href="#settings">
                            <span class="link-collapse">Riwayat Akun</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item {{ setActive(['dashboard']) }}">
            <a href="{{ route('dashboard') }}">
                <i class="la la-dashboard"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['transaction*']) }}">
            <a href="{{ route('transaction.index') }}">
                <i class="la la-comment"></i>
                <p>Riwayat Transaksi</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['distributorproduct*']) }}">
            <a href="{{ route('distributorproduct.index') }}">
                <i class="la la-cube"></i>
                <p>Data Produk Distributor</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['product*']) }}">
            <a href="{{ route('product.index') }}">
                <i class="la la-cube"></i>
                <p>Data Produk</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['place*']) }}">
            <a href="{{ route('place.index') }}">
                <i class="la la-cube"></i>
                <p>Data Kota Distributor</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['user*']) }}">
            <a href="{{ route('user.index') }}">
                <i class="la la-user"></i>
                <p>Data User</p>
            </a>
        </li>
    </ul>
</div>