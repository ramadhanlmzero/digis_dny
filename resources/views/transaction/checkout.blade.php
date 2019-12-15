@section('title')

    @if(Auth::user()->role=='Distributor')
        Riwayat Transaksi
    @elseif(Auth::user()->role=='Admin')
        Data Transaksi
    @endif
@endsection

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
        <form action="{{ route('transaction.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="card-header">
                <div class="card-title">Tabel @yield('title')</div>
            </div>
            <div class="card-body">
                <table id="productTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Nama Produk</th>
                            <th>Harga pcs</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_id as $index => $product_id)
                            <tr>
                                <input type="hidden" name="product_id[]" value="{{ $product_id }}">
                                <input type="hidden" name="stock[]" value="{{ $stock[$index] }}">
                                <input type="hidden" name="qty[]" value="{{ $qty[$index] }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $title[$index] }}</td>
                                <td>{{ $price[$index] }}</td>
                                <td>{{ $qty[$index] }}</td>
                                <td>Rp. {{ number_format($total[$index], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4">Total </th>
                            <td>Rp. {{ number_format(array_sum($total), 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
                    <div class="form-group @error('bayar') has-error @enderror">
                        <label for="bayar">Uang yg Dibayarkan</label>
                        <input type="hidden" name="total" value="{{array_sum($total)}}">
                        <input type="number" class="form-control" id="bayar" name="bayar" placeholder="contoh: joni" value="{{ old('bayar') }}" required min="{{array_sum($total)}}">
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
