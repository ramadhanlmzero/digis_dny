@section('title')
    Data User
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    @if ($user->role == 'Admin')
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="card-header">
                        <div class="card-title">Form Ubah @yield('title') {{ $user->name }}</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="contoh: joni" value="{{ $user->name }}" required>
                            @error('name')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh: joni@gmail.com" value="{{ $user->email }}" required>
                            @error('email')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('role') has-error @enderror">
                            <label for="role">Hak Akses</label>
                            <input type="text" class="form-control" name="role" id="role" value="{{ $user->role }}" readonly required>
                            @error('role')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group pb-0">
                            <label for="photo">Foto Profil</label>
                        </div>
                        <div class="form-group @error('photo') has-error @enderror pt-0">
                            @if($user->photo)
                                @if(file_exists(public_path(). '/storage/user/'. $user->photo))
                                    <img id="preview" height="150" width="150" src="{{asset('storage/user/'. $user->photo)}}">
                                @else
                                    <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                                @endif
                            @else
                                <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                            @endif
                            <input type="file" class="form-control mt-2" id="photo" name="photo" onchange="readURL(this);">
                            @error('photo')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($user->role == 'Distributor')
        <div class="col-md-6 stretch-card">
            <div class="card">
                <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    {{ method_field('put') }}
                    {{ csrf_field() }}
                    <div class="card-header">
                        <div class="card-title">Form Ubah @yield('title') {{ $user->name }}</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="contoh: joni" value="{{ $user->name }}" required>
                            @error('name')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="contoh: joni@gmail.com" value="{{ $user->email }}" required>
                            @error('email')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('role') has-error @enderror">
                            <label for="role">Hak Akses</label>
                            <input type="text" class="form-control" name="role" id="role" value="{{ $user->role }}" readonly required>
                            @error('role')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('place_id') has-error @enderror">
                            <label for="place_id">Asal Kota</label>
                            <select class="form-control" id="place_id" name="place_id">
                                @if ($user->distributor->place_id)
                                <option value="{{ $user->distributor->place_id }}" selected>{{ $user->distributor->place->city }}</option>
                                @endif
                                @foreach ($places as $place)
                                    @if ($user->distributor->place_id != $place->id)
                                    <option value="{{ $place->id }}">{{ $place->city }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('place_id')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                         <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $user->distributor->address }}" required>
                            @error('address')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('gender') has-error @enderror">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender">
                                @if ($user->distributor->gender)
                                <option value="{{ $user->distributor->gender }}" selected>{{ $user->distributor->gender }}</option>
                                @endif
                                @if ($user->distributor->gender != 'Laki-laki')
                                <option value="Laki-laki">Laki-laki</option>
                                @endif
                                @if ($user->distributor->gender != 'Perempuan')
                                <option value="Perempuan">Perempuan</option>
                                @endif
                            </select>
                            @error('gender')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone">No. Telp</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ $user->distributor->phone }}" pattern="^08[0-9]{9,}$" maxlength="12" required>
                            @error('phone')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('capacity') has-error @enderror">
                            <label for="capacity">Target Penjualan</label>
                            <input type="number" class="form-control" name="capacity" id="capacity" value="{{ $user->distributor->capacity }}" required>
                            @error('capacity')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group pb-0">
                            <label for="photo">Foto Profil</label>
                        </div>
                        <div class="form-group @error('photo') has-error @enderror pt-0">
                            @if($user->photo)
                                @if(file_exists(public_path(). '/storage/user/'. $user->photo))
                                    <img id="preview" height="150" width="150" src="{{asset('storage/user/'. $user->photo)}}">
                                @else
                                    <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                                @endif
                            @else
                                <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                            @endif
                            <input type="file" class="form-control mt-2" id="photo" name="photo" onchange="readURL(this);">
                            @error('photo')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" class="form-control" id="lat" name="lat" value="{{ $lat }}">
                        <input type="hidden" class="form-control" id="long" name="long" value="{{ $long }}">
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Simpan</button>
                        <a href="{{ route('user.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 stretch-card">
            <div class="card text-center">
                <div class="card-header">
                    <div class="card-title">Tentukan lokasi pasti anda</div>
                </div>
                <div class="card-body">
                    <div style="width: 100%; height: 470px;">
                        {!! Mapper::render() !!}
                    </div>
                    <div id="infowindow-content">
                        <img src="" width="16" height="16" id="place-icon">
                        <span id="place-name" class="title"></span><br>
                        <span id="place-address"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group @error('lat') has-error @enderror">
                            <label for="lat">Koordinat Lattitude</label>
                            <input type="text" class="form-control" id="lat2" placeholder="geser marker merah pada peta di samping" value="{{ $lat }}" readonly>
                            @error('lat')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group @error('long') has-error @enderror">
                            <label for="long">Koordinat Longitude</label>
                            <input type="text" class="form-control" id="long2" placeholder="geser marker merah pada peta di samping" value="{{ $long }}" readonly>
                            @error('long')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @section('js')
            <script>
                function initMap() {
                    var lat = {!! json_encode($lat, JSON_HEX_TAG) !!};
                    var long = {!! json_encode($long, JSON_HEX_TAG) !!};
                    var input = document.getElementById('address');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.bindTo('bounds', maps[0].map);

                    autocomplete.setFields(
                    ['address_components', 'geometry', 'icon', 'name']);

                    var infowindow = new google.maps.InfoWindow();
                    var infowindowContent = document.getElementById('infowindow-content');
                    infowindow.setContent(infowindowContent);
                    var markerPosition = new google.maps.LatLng(lat, long);
                    var marker = new google.maps.Marker({
                        position: markerPosition,
                    });
                    marker.setMap(maps[0].map);

                    autocomplete.addListener('place_changed', function() {
                        var place = autocomplete.getPlace();
                        
                        if (!place.geometry) {
                            window.alert("No details available for input: '" + place.name + "'");
                            return;
                        }

                        if (place.geometry.viewport) {
                            maps[0].map.fitBounds(place.geometry.viewport);
                        } 
                        else {
                            maps[0].map.setCenter(place.geometry.location);
                            maps[0].map.setZoom(17);
                        }
                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);

                        var address = '';
                        if (place.address_components) {
                            address = [
                            (place.address_components[0] && place.address_components[0].short_name || ''),
                            (place.address_components[1] && place.address_components[1].short_name || ''),
                            (place.address_components[2] && place.address_components[2].short_name || '')
                            ].join(' ');
                        }

                        infowindowContent.children['place-icon'].src = place.icon;
                        infowindowContent.children['place-name'].textContent = place.name;
                        infowindowContent.children['place-address'].textContent = address;
                        infowindow.open(maps[0].map, marker);
                        
                        document.getElementById('lat').value = place.geometry.location.lat();
                        document.getElementById('long').value = place.geometry.location.lng();
                        document.getElementById('lat2').value = place.geometry.location.lat();
                        document.getElementById('long2').value = place.geometry.location.lng();
                    });
                }
                google.maps.event.addDomListener(window, 'load', initMap);
            </script>
        @endsection
    @endif
</div>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection