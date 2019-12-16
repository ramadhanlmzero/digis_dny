@section('title')
    Data Produk
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Rincian Transaksi</div>
                <div class="card-title">{{ \Carbon\Carbon::parse($transactions->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y, %H:%M') }}</div>
                 @if (Auth::user()->role == 'Admin')
                <div class="card-title">Distributor : {{ $transactions->distributor->user->name }}</div>
                @endif
            </div>
            <div class="card-body">
                @foreach ($transactions->product as $index=>$transaction )
                <div class="row">
                    <div class="col-md-7">
                        <div>
                            <table border="0">
                                <tr>
                                    <td>Nama Produk</td>
                                    <td>:</td>
                                    <td>{{ $transaction->title }}</td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($transaction->price, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Qty</td>
                                    <td>:</td>
                                    <td>{{ $transaction->pivot->qta }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>:</td>
                                    <td>{{ $transaction->price*$transaction->pivot->qta }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5">
                        @if($transaction->image)
                            @if(file_exists(public_path(). '/storage/product/'. $transaction->image))
                                <img src="{{asset('storage/product/'. $transaction->image)}}" width="200" alt="image" style="margin-right: 10px;" />
                            @else
                                <img src="{{asset('assets/images/nopic.jpg')}}" width="200" alt="image" style="margin-right: 10px;" /> 
                            @endif
                        @else
                            <img src="{{asset('assets/images/nopic.jpg')}}" width="200" alt="image" style="margin-right: 10px;" /> 
                        @endif
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="row">
                    <div class="col-md-7">
                        <div>
                            <table border="0">
                                <tr>
                                    <td>Total Tagihan</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($transactions->total_price, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($transactions->total_paid, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td>Kembalian</td>
                                    <td>:</td>
                                    <td>Rp. {{ number_format($transactions->total_change, 2, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection