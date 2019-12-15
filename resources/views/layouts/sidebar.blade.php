<div class="scrollbar-inner sidebar-wrapper">
    <div class="user">
        <div class="photo">
            @if(Auth::user()->photo!=null)
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
                    @if (Auth::user()->role == 'Distributor')
                        <li>
                            <a href="{{ route('profile.index', Auth::user()->id . "#about") }}">
                                <span class="link-collapse">Profil Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.index', Auth::user()->id . "#product") }}">
                                <span class="link-collapse">Stok Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.index', Auth::user()->id . "#transaction") }}">
                                <span class="link-collapse">Riwayat Transaksi</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'Admin')
                        <li>
                            <a href="{{ route('user.edit', Auth::user()->id) }}">
                                <span class="link-collapse">Ubah Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.reset', Auth::user()->id) }}">
                                <span class="link-collapse">Ubah Password</span>
                            </a>
                        </li>
                    @endif
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
        @if(Auth::user()->role=='Distributor')
        <li class="nav-item {{ setActive(['transaction*']) }}">
            <a href="{{ route('transaction.index') }}">
                <i class="la la-comment"></i>
                <p>Riwayat Transaksi</p>
            </a>
        </li>
        @elseif(Auth::user()->role=='Admin')
        <li class="nav-item {{ setActive(['transaction*']) }}">
            <a href="{{ route('transaction.index') }}">
                <i class="la la-comment"></i>
                <p>Data Transaksi</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['place*']) }}">
            <a href="{{ route('place.index') }}">
                <i class="la la-cube"></i>
                <p>Data Kota Distributor</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['product*']) }}">
            <a href="{{ route('product.index') }}">
                <i class="la la-cube"></i>
                <p>Data Produk</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['distributorproduct*']) }}">
            <a href="{{ route('distributorproduct.index') }}">
                <i class="la la-cube"></i>
                <p>Data Produk Distributor</p>
            </a>
        </li>
        <li class="nav-item {{ setActive(['user*']) }}">
            <a href="{{ route('user.index') }}">
                <i class="la la-user"></i>
                <p>Data User</p>
            </a>
        </li>
        @endif
    </ul>
</div>