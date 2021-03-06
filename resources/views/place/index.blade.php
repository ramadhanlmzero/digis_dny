@section('title')
    Data Kota Distributor
@endsection

@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('place.create') }}">
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
                <table id="placeTable" class="table table-bordered table-head-bg-info table-bordered-bd-info">
                    <thead>
                        <tr>
                            <th width="30">No.</th>
                            <th>Kota</th>
                            <th>Jumlah Distributor</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($places as $index => $place)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $place->city }}</td>
                                <td>{{ $place->distributor->count() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('place.show', $place->id) }}" class="btn btn-primary px-2 py-1">
                                            <i class="la la-eye"></i>
                                        </a>
                                        <a href="{{ route('place.edit', $place->id) }}" class="btn btn-success px-2 py-1 mx-2">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('place.destroy', $place->id) }}" method="post">
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
                <div class="card-title">Sebaran Distributor di Jawa Timur</div>
            </div>
            <div class="card-body">
                <div style="width: 100%; height: 350px;">
                    {!! Mapper::render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/plugin/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('js')
    <script src="{{asset('jatim.geojson')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugin/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#placeTable").DataTable({
                "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ kota",
                    "sZeroRecords": "Belum ada kota apapun",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ kota",
                    "sSearch": "Cari: ",
                    "oPaginate": {
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya",
                    }
                },
                stateSave: true
            });
            function initMap() {
                var places = {!! json_encode($places->toArray(), JSON_HEX_TAG) !!};
                var geo = maps[0].map.data;
                geo.addGeoJson(jatim);
                geo.setStyle(function(feature) {  
                    var KABKOT = feature.getProperty('KABKOT');
                    var color = "gray";
                    places.forEach(element => {
                        if (element.distributor.length > 0) {
                            if (KABKOT == element.city) {
                                color = "yellow";
                            }
                        }
                        if (element.distributor.length < 1) {
                            if (KABKOT == element.city) {
                                color = "red";
                            }
                        }
                    });
                    return {
                        fillColor: color,
                        strokeWeight: 1
                    }
                });
                var infowindow = new google.maps.InfoWindow();
                geo.addListener('click', function(data_mouseEvent) {
                    var feature = data_mouseEvent.feature;
                    feature.toGeoJson(function(geojson){
                        var name = geojson.properties.KABKOT;
                        places.forEach(element => {
                            if (name == element.city) {
                                var distributor = element.distributor.length;
                                var myHTMLss = 'Kota: '+ name + '<br>' +
                                'Jumlah Distributor: '+ element.distributor.length + '<br>' +
                                "<a href='/dashboard/place/" + element.id + "' class='btn btn-primary px-2 py-1'>Lihat Detail</a>";
                                infowindow.setContent(myHTMLss);
                                infowindow.setPosition(data_mouseEvent.latLng);
                                infowindow.open(maps[0].map);
                            }
                        });
                    });
                });
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        });
    </script>
@endsection