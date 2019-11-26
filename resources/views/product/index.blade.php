@section('title')
    Data Produk
@endsection

@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('product.create') }}">
        <button type="button" class="btn btn-info">Tambah Data</button>
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel @yield('title')</div>
            </div>
            <div class="card-body">
                <table id="productTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Judul Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Distributor</th>
                            <th>Total Penjualan</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $product->title }}</td>
                                <td>Rp. {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td>{{ $product->distributor->count() }}</td>
                                <td>{{ $product->transaction->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary px-2 py-1">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success px-2 py-1 mx-2">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                            <button class="btn btn-danger px-2 py-1" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> 
                                                <i class="la la-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/plugin/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugin/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#productTable").DataTable({
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ produk",
                    "sZeroRecords": "Belum ada produk apapun",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ produk",
                    "sSearch": "Cari: ",
                    "oPaginate": {
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya",
                    }
                },
                stateSave: true
            });
        });
    </script>
@endsection