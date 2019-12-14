@section('title')
    Data Produk Distributor
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
             <form action="{{ route('distributorproduct.update', $distributor->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('put') }}
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Form Ubah Data Produk {{ $distributor->user->name }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_id">Produk untuk Distributor</label>
                        @foreach ($products as $product)
                        <div class="form-inline my-2">
                            <div class="form-check p-0 mr-4">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="product_id[]" value="{{ $product->id }}" @if ($distributor->product->contains($product->id)) checked @endif>
                                    <span class="form-check-sign">{{ $product->title }}</span>
                                </label>
                            </div>
                            @if ($distributor->product->contains($product->id))
                                @foreach ($product->distributor as $item)
                                    @if ($item->pivot->distributor_id == $distributor->id)
                                        <div class="stock">
                                            <input type="number" class="form-control form-control-sm col-5" name="stock[]" value="{{ $item->pivot->stock }}">
                                        </div>
                                    @endif
                                @endforeach
                            @else 
                            <div class="stock" style="display:none;"></div>
                            @endif
                        </div>
                        @endforeach
                        @if($errors->any())
                            <span class="form-text text-danger">
                                {{$errors->first()}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <a href="{{ route('distributorproduct.index') }}" class="btn btn-danger">Batal</a>
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
        $('input[type=checkbox]').each(function () {
            $(this).click(function() {
                $(this).closest('div').next().toggle();
            });
        });
        $('input[type=checkbox]').change(function () {
            if ($(this).is(':checked')) {
                $(this).closest('div').next().append('<input type="number" class="form-control form-control-sm col-5" name="stock[]">');
            }
            else {
                $(this).closest('div').next().find('.form-control-sm').remove();
            } 
        });
    </script>
@endsection