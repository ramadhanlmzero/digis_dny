@section('title')
    @if(Auth::user()->role=='Distributor')
        Riwayat Transaksi
    @elseif(Auth::user()->role=='Admin')
        Data Transaksi
    @endif
@endsection

@extends('layouts.app')

@section('content')
@if(Auth::user()->role=='Distributor')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">@yield('title') Anda</div>
            </div>
            <div class="card-body">
                <table id="transactionTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Tagihan</th>
                            <th>Jumlah yg Dibayarkan</th>
                            <th>Kembalian</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $index => $transaction)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y') }}</td>
                                <td class="text-right">Rp. {{ number_format($transaction->total_price, 2, ',', '.') }}</td>
                                <td class="text-right">Rp. {{ number_format($transaction->total_paid, 2, ',', '.') }}</td>
                                <td class="text-right">Rp. {{ number_format($transaction->total_change, 2, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary px-2 py-1">
                                            <i class="la la-eye"></i>
                                        </a>
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
@elseif(Auth::user()->role=='Admin')
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
                            <th>Tanggal Transaksi</th>
                            <th>Distributor</th>
                            <th>Total Tagihan</th>
                            <th>Jumlah yg Dibayarkan</th>
                            <th>Kembalian</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $index => $transaction)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->distributor->user->name }}</td>
                                <td>{{ $transaction->total_price }}</td>
                                <td>{{ $transaction->total_paid }}</td>
                                <td>{{ $transaction->total_change }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-primary px-2 py-1">
                                            <i class="la la-eye"></i>
                                        </a>
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
@endif

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/plugin/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugin/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#transactionTable").DataTable({
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ transaksi",
                    "sZeroRecords": "Belum ada transaksi",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ transaksi",
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