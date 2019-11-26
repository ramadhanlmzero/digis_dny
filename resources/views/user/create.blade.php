@section('title')
    Data User
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Form Tambah @yield('title')</div>
                </div>
                <div class="card-body">
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="contoh: joni" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('email') has-error @enderror">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="contoh: joni@gmail.com" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('password') has-error @enderror">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="contoh: joni123" value="{{ old('password') }}" required>
                        @error('password')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('role') has-error @enderror">
                        <label for="role">Hak Akses</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Admin" @if (old('role') == 'Admin') selected @endif>Admin</option>
                            <option value="Distributor" @if (old('role') == 'Distributor') selected @endif>Distributor</option>
                        </select>
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
                        <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
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