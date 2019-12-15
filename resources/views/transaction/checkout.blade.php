@section('title')
    Buat Transaksi
@endsection

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $total = 0;
            @endphp
            <div class="card-header">
                <div class="card-title">Ringkasan Pesanan</div>
            </div>
            <div class="card-body">
                <table id="productTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <input type="hidden" name="product_id[]" value="{{ $product_id[$index] }}">
                            <input type="hidden" name="qty[]" value="{{ $qty[$index] }}">
                            @foreach ($product->distributor as $item)
                                @if ($item->pivot->distributor_id == $distributor->id)
                                <input type="hidden" name="stock[]" value="{{ $item->pivot->stock }}">
                                @endif
                            @endforeach
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $qty[$index] }}</td>
                                <td>Rp. {{ number_format($product->price*$qty[$index], 2, ',', '.') }}</td>
                            </tr>
                            @php
                                $total += ($product->price*$qty[$index]);
                            @endphp
                        @endforeach
                        <tr>
                            <th colspan="4">Total </th>
                            <td>Rp. {{ number_format($total, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                    <div class="form-group @error('bayar') has-error @enderror">
                        <label for="bayar">Uang yg Dibayarkan</label>
                        <input type="hidden" name="total" value="{{ $total }}">
                        <input type="number" class="form-control" id="bayar" name="bayar" value="{{ old('bayar') }}" required min="{{ $total }}">
                        @error('bayar')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
            </div>
            <div class="card-action">
                <button class="btn btn-success" type="submit">Bayar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
