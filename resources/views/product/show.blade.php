@section('title')
    Data Produk
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Rincian Produk {{ $product->title }}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div>
                            <p>
                                <span class="font-weight-bold">Nama Produk : </span> {{ $product->title }}
                            </p>
                            <p>
                                <span class="font-weight-bold">Harga : </span> Rp. {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                            <p>
                                <span class="font-weight-bold">Deskripsi Produk : </span> {{ $product->description }}
                            </p>
                        </div>
                        <hr>
                        <div>
                            <p class="font-weight-bold">
                                Jumlah Distributor : {{ $product->distributor->count() }}
                            </p>
                            <p class="font-weight-bold">
                                Daftar Nama Distributor Produk {{ $product->city }} :
                            </p>
                            @if (!$product->distributor->isEmpty())
                                <ol>
                                    @foreach ($product->distributor as $distributor)
                                        <li>{{ $distributor->user->name }} ({{ $distributor->place->city }})</li>
                                    @endforeach
                                </ol> 
                            @else 
                                <p>Belum ada distributor</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        @if($product->image)
                            @if(file_exists(public_path(). '/storage/product/'. $product->image))
                                <img src="{{asset('storage/product/'. $product->image)}}" width="350" alt="image" style="margin-right: 10px;" />
                            @else
                                <img src="{{asset('assets/images/nopic.jpg')}}" width="350" alt="image" style="margin-right: 10px;" /> 
                            @endif
                        @else
                            <img src="{{asset('assets/images/nopic.jpg')}}" width="350" alt="image" style="margin-right: 10px;" /> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection