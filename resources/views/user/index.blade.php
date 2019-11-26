@section('title')
    Data User
@endsection

@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('user.create') }}">
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
                <table id="userTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th width="40">Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>
                                    @if($user->photo)
                                        @if(file_exists(public_path(). '/storage/user/'. $user->photo))
                                            <img src="{{asset('storage/user/'. $user->photo)}}" width="50" alt="image" style="margin-right: 10px;" />
                                        @else
                                            <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" style="margin-right: 10px;" /> 
                                        @endif
                                    @else
                                        <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" style="margin-right: 10px;" /> 
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.reset', $user->id) }}" class="btn btn-warning px-2 py-1">
                                            <i class="la la-key"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success px-2 py-1 mx-2">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel Data Distributor</div>
            </div>
            <div class="card-body">
                <table id="distributorTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th width="40">Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Asal Kota</th>
                            <th>Target Penjualan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributors as $index => $distributor)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>
                                    @if($distributor->photo)
                                        @if(file_exists(public_path(). '/storage/user/'. $distributor->photo))
                                            <img src="{{asset('storage/user/'. $distributor->photo)}}" width="50" alt="image" style="margin-right: 10px;" />
                                        @else
                                            <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" style="margin-right: 10px;" /> 
                                        @endif
                                    @else
                                        <img src="{{asset('assets/images/nopic.jpg')}}" width="50" alt="image" style="margin-right: 10px;" /> 
                                    @endif
                                </td>
                                <td>{{ $distributor->name }}</td>
                                <td>{{ $distributor->email }}</td>
                                <td>
                                    @if ( $distributor->distributor->place_id)
                                    {{ $distributor->distributor->place->city }}
                                    @else
                                      
                                    @endif
                                </td>
                                <td>{{ $distributor->distributor->capacity }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.show', $distributor->id) }}" class="btn btn-primary px-2 py-1 mr-2">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{ route('user.reset', $distributor->id) }}" class="btn btn-warning px-2 py-1">
                                            <i class="la la-key"></i>
                                        </a>
                                        <a href="{{ route('user.edit', $distributor->id) }}" class="btn btn-success px-2 py-1 mx-2">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('user.destroy', $distributor->id) }}" method="post">
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
            $("#userTable").DataTable({
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ user",
                    "sZeroRecords": "Belum ada user apapun",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ user",
                    "sSearch": "Cari: ",
                    "oPaginate": {
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya",
                    }
                },
                stateSave: true
            });
            $("#distributorTable").DataTable({
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