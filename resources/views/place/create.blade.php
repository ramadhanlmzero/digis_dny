@section('title')
    Data Kota Distributor
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 stretch-card">
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
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('place.index') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection