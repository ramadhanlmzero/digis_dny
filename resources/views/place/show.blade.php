@section('title')
    Data Kota Distributor
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Rincian Distribusi Produk di Kota {{ $place->city }}</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <p class="font-weight-bold">
                                Jumlah Distributor : {{ $place->distributor->count() }}
                            </p>
                        </div>
                        <hr>
                        <div>
                            <p class="font-weight-bold">
                                Daftar Nama Distributor di {{ $place->city }} :
                            </p>
                            @if (!$distributors->isEmpty())
                                <ol>
                                    @foreach ($distributors as $distributor)
                                    <li>{{ $distributor->user->name }} (target penjualan: {{ $distributor->capacity }}/bulan)</li>
                                    @endforeach
                                </ol> 
                            @else 
                                <p>Belum ada distributor</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 pull-right">
                        <p class="font-weight-bold">Lokasi pada Peta</p>
                        <div style="width: 100%; height: 350px;">
                            {!! Mapper::render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection