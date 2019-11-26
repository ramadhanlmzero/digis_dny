@section('title')
    Data Kota Distributor
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 stretch-card">
        <div class="card">
            <form action="{{ route('place.store') }}" method="post">
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Form Tambah @yield('title')</div>
                </div>
                <div class="card-body">
                    <div class="form-group @error('city') has-error @enderror">
                        <label for="city">Nama Kota</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="contoh: surabaya" value="{{ old('city') }}" required>
                        @error('city')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('lat') has-error @enderror">
                        <label for="lat">Koordinat Lattitude Kota</label>
                        <input type="text" class="form-control" id="lat" name="lat" placeholder="geser marker merah pada peta di samping" value="{{ old('lat') }}" readonly required>
                        @error('lat')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('long') has-error @enderror">
                        <label for="long">Koordinat Longitude Kota</label>
                        <input type="text" class="form-control" id="long" name="long" placeholder="geser marker merah pada peta di samping" value="{{ old('long') }}" readonly required>
                        @error('long')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('place.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-7 stretch-card">
        <div class="card text-center">
            <div style="width: 100%; height: 470px;">
                {!! Mapper::render() !!}
            </div>
        </div>
    </div>
</div>
@endsection