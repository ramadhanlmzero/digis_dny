@section('title')
    Buat Transaksi
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
             <form action="{{ route('transaction.checkout') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Buat Transaksi {{ $distributor->user->name }}</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="product_id">Daftar Barang</label>
                        
                        @foreach ($products as $product)
                            @if($distributor->product->contains($product->id))
                                <div class="form-inline my-2">
                                    <div class="form-check p-0 mr-4">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="product_id[]" value="{{ $product->id }}" checked>
                                            <span class="form-check-sign">{{ $product->title }} (Rp. {{ number_format($product->price, 2, ',', '.') }})</span>
                                        </label>
                                    </div>
                                    
                                    @if ($distributor->product->contains($product->id))
                                        @foreach ($product->distributor as $item)
                                            @if ($item->pivot->distributor_id == $distributor->id)
                                                <div class="qty">
                                                    <input type="number" class="form-control form-control-sm col-5" id="price" name="qty[]" value="">
                                                </div>
                                            @endif
                                        @endforeach
                                    @else 
                                    <div class="qty" style="display:none;"></div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        @if($errors->any())
                            <span class="form-text text-danger">
                                {{$errors->first()}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Lanjut</button>
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
                $(this).closest('div').next().append('<input type="number" class="form-control form-control-sm col-5" name="qty[]">');
            }
            else {
                $(this).closest('div').next().find('.form-control-sm').remove();
            } 
        });
    </script>
@endsection