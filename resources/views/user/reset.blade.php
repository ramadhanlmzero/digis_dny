@section('title')
    Data User
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('user.resetpassword', $user->id) }}" method="post">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Form Reset Password User {{ $user->name }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group @error('oldpassword') has-error @enderror">
                        <label for="oldpassword">Password Lama</label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="contoh: joni123" required>
                        @if (session()->has('error'))
                            <span class="form-text text-danger">
                                {{ session()->get('error') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="newpassword">Password Baru</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="contoh: joni123" required>
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