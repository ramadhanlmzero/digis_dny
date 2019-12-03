@section('title')
    Data Produk Distributor
@endsection

@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel @yield('title')</div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Nama Distributor</th>
                            <th>Kapasitas Gudang</th>
                            <th>Jumlah Produk di Gudang</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributors as $index => $distributor)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $distributor->user->name }}</td>
                                <td>{{ $distributor->capacity }}</td>
                                <td>
                                    @if ($distributor->product->isEmpty())
                                        0
                                    @else
                                        {{ $distributor->product()->get()->sum('pivot.stock') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('distributorproduct.show', $distributor->id) }}" class="btn btn-primary px-2 py-1">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{ route('distributorproduct.edit', $distributor->id) }}" class="btn btn-success px-2 py-1 mx-2">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('distributorproduct.destroy', $distributor->id) }}" method="post">
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
            $("table.table-head-bg-info").DataTable({
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ distributor",
                    "sZeroRecords": "Belum ada distributor apapun",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ distributor",
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