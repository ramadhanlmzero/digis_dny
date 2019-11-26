@section('title')
    Data Produk
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
             <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Form Ubah @yield('title') {{ $product->title }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group @error('title') has-error @enderror">
                        <label for="title">Judul Produk</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="contoh: hijab sport" value="{{ $product->title }}" required>
                        @error('title')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="description">Deskripsi Produk</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="contoh: produk ini recommended" required>{{ $product->description }}</textarea>
                        @error('description')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                     <div class="form-group @error('price') has-error @enderror">
                        <label for="price">Harga Produk</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{ $product->price }}" required>
                        @error('price')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group pb-0">
                        <label for="image">Gambar Produk</label>
                    </div>
                    <div class="form-group @error('image') has-error @enderror pt-0">
                        @if($product->image)
                            @if(file_exists(public_path(). '/storage/product/'. $product->image))
                                <img id="preview" height="150" width="150" src="{{asset('storage/product/'. $product->image)}}">
                            @else
                                <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                            @endif
                        @else
                            <img id="preview" height="150" width="150" src="{{ asset('assets/images/nopic.jpg') }}">
                        @endif
                        <input type="file" class="form-control mt-2" id="image" name="image" onchange="readURL(this);">
                        @error('image')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('product.index') }}" class="btn btn-danger">Batal</a>
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