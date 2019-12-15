@section('title')
    Profil
@endsection
@extends('layouts.app')

@section('content')
<div class="mb-4">
    @if(Auth::user()->role=='Distributor')
        <a href="{{ route('profile.edit', $user->id) }}">
            <button type="button" class="btn btn-success">Ubah Data</button>
        </a>
        <a href="{{ route('profile.reset', $user->id) }}" class="ml-2">
            <button type="button" class="btn btn-warning">Ubah Password</button>
        </a>
    @elseif(Auth::user()->role=='Admin')
        <a href="{{ route('user.edit', $user->id) }}">
            <button type="button" class="btn btn-success">Ubah Data</button>
        </a>
        <a href="{{ route('user.reset', $user->id) }}" class="ml-2">
            <button type="button" class="btn btn-warning">Ubah Password</button>
        </a>
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Profil {{ $user->name }}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 pr-md-5">
                        @if($user->photo)
                            @if(file_exists(public_path(). '/storage/user/'. $user->photo))
                                <img src="{{asset('storage/user/'. $user->photo)}}" width="50" alt="image" class="w-100 rounded border" />
                            @else
                                <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" class="w-100 rounded border" /> 
                            @endif
                        @else
                            <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" class="w-100 rounded border" /> 
                        @endif
                        <div class="pt-4 mt-2">
                            <section class="mb-4 pb-1">
                                <div class="work-experience pt-2">
                                    <div class="work mb-4">
                                        <strong class="h5 d-block text-secondary font-weight-bold mb-1">Bergabung Sejak</strong>
                                        <p class="text-secondary">{{Carbon\Carbon::parse($user->created_at, 'Asia/Jakarta')->locale('ID')->diffForHumans()}}</p>
                                    </div>
                                    <div class="work mb-4">
                                        <strong class="h5 d-block text-secondary font-weight-bold mb-1">Tanggal Bergabung</strong>
                                        <p class="text-secondary">{{Carbon\Carbon::parse($user->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y')}}</p>
                                    </div>
                                    <div class="work mb-4">
                                        <strong class="h5 d-block text-secondary font-weight-bold mb-1">Kapasitas Gudang</strong>
                                        <p class="text-secondary">{{$user->distributor->capacity}}</p>
                                    </div>
                                </div>    
                            </section>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <h3 class="font-weight-bold m-0">
                                {{$user->name}}
                            </h3>
                        </div>
                        <p class="h5 text-primary mt-2 d-block font-weight-light">
                            {{$user->role}} {{$user->distributor->place->city}}
                        </p>
                        <p class="lead mt-4">
                            {{$user->distributor->address}}
                        </p>
                        <section class="mt-5">
                            <h3 class="h6 font-weight-light text-secondary text-uppercase">Total Penjualan</h3>
                            <div class="d-flex align-items-center">
                                <strong class="h1 font-weight-bold m-0 mr-3">
                                    {{$user->distributor->transaction->count()}}
                                </strong>
                                <div>
                                    <input data-filled="fa fa-2x fa-star mr-1 text-warning" data-empty="fa fa-2x fa-star-o mr-1 text-light" value="5" type="hidden" class="rating" data-readonly />
                                </div>
                            </div>
                        </section>
                        <section class="mt-4">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" aria-selected="true">
                                        Tentang
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" aria-controls="product" aria-selected="false">
                                        Stok Produk  
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="transaction-tab" data-toggle="tab" href="#transaction" aria-controls="transaction" aria-selected="false">
                                        Riwayat Transaksi    
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-4" id="myTabContent">
                                <div class="tab-pane py-3 fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <h6 class="text-uppercase font-weight-light text-secondary">
                                        Informasi Kontak
                                    </h6>
                                    <dl class="row mt-4 mb-4 pb-3">
                                        <dt class="col-sm-3">No. HP</dt>
                                        <dd class="col-sm-9">{{$user->distributor->phone}}</dd>
                                        
                                        <dt class="col-sm-3">Alamat Rumah</dt>
                                        <dd class="col-sm-9">
                                            <address class="mb-0">
                                                {{$user->distributor->address}}
                                            </address>
                                        </dd>
                                        <dt class="col-sm-3">Email</dt>
                                        <dd class="col-sm-9">{{$user->email}}</dd>
                                    </dl>
                                    
                                    <h6 class="text-uppercase font-weight-light text-secondary">
                                        Informasi Dasar
                                    </h6>
                                    <dl class="row mt-4 mb-4 pb-3">                                        
                                        <dt class="col-sm-3">Jenis Kelamin</dt>
                                        <dd class="col-sm-9">{{$user->distributor->gender}}</dd>
                                    </dl>
                                </div>
                                <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                                    <p class="font-weight-bold">
                                        Jenis Produk : {{ $distributor->product->count() }}
                                    </p>
                                    <p class="font-weight-bold">
                                        Stok Produk :
                                    </p>
                                    @if (!$distributor->product->isEmpty())
                                        <ol class="pl-3">
                                            @foreach ($distributor->product as $product)
                                            <p>
                                                <li>
                                                    <p class="my-0">
                                                        {{ $product->title }}
                                                    </p>
                                                    <p class="my-0">
                                                        Stok: {{ $product->pivot->stock }} buah
                                                    </p>
                                                    <p class="my-0">
                                                        Update terakhir: {{ Carbon\Carbon::parse($product->pivot->updated_at, 'Asia/Jakarta')->locale('ID')->diffForHumans() }}
                                                    </p>
                                                </li>
                                            </p>
                                            @endforeach
                                        </ol> 
                                    @else 
                                        <p>Belum ada produk</p>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                                    <p class="font-weight-bold">
                                        Total Transaksi : {{ $distributor->transaction->count() }}
                                    </p>
                                    <p class="font-weight-bold">
                                        Riwayat Transaksi :
                                    </p>
                                    @if (!$distributor->transaction->isEmpty())
                                        <ol type="1" class="pl-3">
                                            @foreach ($distributor->transaction as $transaction)
                                            <p>
                                                <li>
                                                    <p class="my-0">
                                                        {{ \Carbon\Carbon::parse($transaction->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y') }}
                                                    </p>
                                                    <p class="my-0">
                                                        Total Belanjaan: 
                                                        @php
                                                            $qta = 0;
                                                            foreach($transaction->product as $product) {
                                                                $qta += $product->pivot->qta;
                                                            }
                                                        @endphp
                                                        {{ $qta }}
                                                    </p>
                                                    <p class="my-0">
                                                        Jenis Produk: 
                                                        <ol type="a" class="pl-3">
                                                            @foreach($transaction->product as $index => $product)
                                                                <li>
                                                                    {{ $product->title }}: {{ $product->pivot->qta }} buah
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    </p>
                                                </li>
                                            </p>
                                            @endforeach
                                        </ol> 
                                    @else 
                                        <p>Belum ada transaksi</p>
                                    @endif
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var url = document.URL;
        var hash = url.substring(url.indexOf('#'));

        $(".nav-tabs").find("li a").each(function(key, val) {
            if (hash == $(val).attr('href')) {
                $(val).click();
            }
            
            $(val).click(function(ky, vl) {
                location.hash = $(this).attr('href');
            });
        });
    </script>
@endsection