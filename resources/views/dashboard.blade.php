@section('title')
    Dashboard
@endsection

@extends('layouts.app')

@section('content')
@if (Auth::user()->role == 'Admin')
<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-users"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Distributor</p>
                            <h4 class="card-title">{{ $totalDistributors }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la la-map"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Kota</p>
                            <h4 class="card-title">{{ $totalPlaces }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la la-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Produk</p>
                            <h4 class="card-title">{{ $totalProducts }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-primary">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-bar-chart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Penjualan</p>
                            <h4 class="card-title">{{ $totalTransactions }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sebaran Distributor</h4>
                <p class="card-category">Peta informasi sebaran distributor DNY Hijab Sport di Jawa Timur.</p>
            </div>
            <div class="card-body">
                {{-- <div class="mb-4">
                    <label for="">Pilih Tahun</label>
                    <select name="test" id="test" class="form-control" onchange="changeMap(this.value)">
                        <option disabled selected>Pilih salah satu</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                    </select>
                </div> --}}
                <div style="width: 100%; height: 350px;">
                    {!! Mapper::render() !!}
                    <div id="legend"><h6 class="font-weight-bold">Legend</h6></div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif(Auth::user()->role == 'Distributor')
<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-users"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Status Anda</p>
                            <h4 class="card-title">{{ Auth::user()->role }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la la-map"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Kota Anda</p>
                            <h4 class="card-title">{{ $your->place->city }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la la-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Produk Anda</p>
                            <h4 class="card-title">{{ $your->product->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-primary">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-bar-chart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center pl-0">
                        <div class="numbers">
                            <p class="card-category">Penjualan Anda</p>
                            <h4 class="card-title">{{ $your->transaction->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding-bottom:297px;"></div>
@endif
@endsection

@section('css')
    <style>
        #legend {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 10px;
            margin: 10px;
            border: 2px solid #000;
            max-width: 250px;
        }

        #legend h6 {
            margin-top: 0;
            font-size: 15px;
        }

        #legend img {
            vertical-align: middle;
        }
    </style>
@endsection

@section('js')
    {{-- <script src="{{asset('test1.geojson')}}" type="text/javascript"></script>
    <script src="{{asset('test2.geojson')}}" type="text/javascript"></script>
    <script src="{{asset('test3.geojson')}}" type="text/javascript"></script>
    <script>
            var geo;
            function initMap() {
                geo = maps[0].map.data;
                geo.setStyle(function(feature) {  
                    var WA = feature.getProperty('WA');
                    color = "gray";
                    if (WA == "KOTA SURABAYA") {
                        color = "yellow";
                    }
                    else if (WA == "KAB. LAMONGAN") {
                        color = "red";
                    }
                    else {
                        color = "green";
                    }
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
                var legend = document.getElementById('legend');
                var div = document.createElement('div');
                div.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: black; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor = 0";
                var div2 = document.createElement('div');
                div2.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: red; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor > 0 & Transaksi = 0";
                var div3 = document.createElement('div');
                div3.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: yellow; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor > 0 & Transaksi > 0";
                legend.appendChild(div);
                legend.appendChild(div2);
                legend.appendChild(div3);
                maps[0].map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        $(document).ready(function() {
        });
        function changeMap(year) {
            if (year == 2019) {
                if(geo) {
                    geo.forEach(function (feature) {
                        geo.remove(feature);
                    });
                }
                geo.addGeoJson(test1);
                geo.addGeoJson(test2);
            }
            else if (year == 2018) {
                if(geo) {
                    geo.forEach(function (feature) {
                        geo.remove(feature);
                    });
                }
                geo.addGeoJson(test2);
            }
            else if (year == 2017) {
                if(geo) {
                    geo.forEach(function (feature) {
                        geo.remove(feature);
                    });
                }
                geo.addGeoJson(test3);
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        }
    </script> --}}
    <script src="{{asset('jatim.geojson')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            function initMap() {
                var places = {!! json_encode($places->toArray(), JSON_HEX_TAG) !!};
                var geo = maps[0].map.data;
                geo.addGeoJson(jatim);
                geo.setStyle(function(feature) {  
                    var KABKOT = feature.getProperty('KABKOT');
                    var color = "gray";
                    places.forEach(element => {
                        element.distributor.forEach(item => {
                            if (KABKOT == element.city) {
                                if (item.transaction.length > 0) {
                                    color = "yellow";
                                }
                                if (item.transaction.length < 1) {
                                    color = "red";
                                }
                            }
                        })
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
                var legend = document.getElementById('legend');
                var div = document.createElement('div');
                div.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: black; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor = 0";
                var div2 = document.createElement('div');
                div2.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: red; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor > 0 & Transaksi = 0";
                var div3 = document.createElement('div');
                div3.innerHTML = "<img src='data:image/svg+xml;utf8,<svg viewBox=\"0 0 100 100\" height=\"" + 8 * 13 / 8 + "\" width=\"" + 8 * 13 / 8 + "\" xmlns=\"http://www.w3.org/2000/svg\"><circle cx=\"50\" cy=\"50\" r=\"50\" style=\"fill: yellow; stroke: white; stroke-width: 1;\"/></svg>'> " + "Distributor > 0 & Transaksi > 0";
                legend.appendChild(div);
                legend.appendChild(div2);
                legend.appendChild(div3);
                maps[0].map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
            }
            google.maps.event.addDomListener(window, 'load', initMap);
        });
    </script>
@endsection