@section('title')
    Buat Transaksi
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Peringatan!</strong> {{ $errors->first() }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
             <form action="{{ route('transaction.checkout') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-header">
                    <div class="card-title">Transaksi Baru</div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-2">
                            @if($distributor->user->photo)
                                @if(file_exists(public_path(). '/storage/user/'. $distributor->user->photo))
                                    <img src="{{asset('storage/user/'. $distributor->user->photo)}}" width="120" alt="image" />
                                @else
                                    <img src="{{asset('assets/images/nopic.jpg')}}" width="120" alt="image" /> 
                                @endif
                            @else
                                <img src="{{asset('assets/images/nopic.jpg')}}" width="120" alt="image" /> 
                            @endif
                        </div>
                        <div class="col-md-10">
                            <p>
                                <span class="font-weight-bold">ID Distributor :</span> {{ $distributor->id }}
                            </p>
                            <p>
                                <span class="font-weight-bold">Nama Distributor :</span> {{ $distributor->user->name }}
                            </p>
                            <p>
                                <span class="font-weight-bold">Asal Kota :</span> {{ $distributor->place->city }}
                            </p>
                            <p>
                                <span class="font-weight-bold">Kapasitas Gudang :</span> {{ $distributor->capacity }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6 for="product_id" class="font-weight-bold">Daftar Produk</h6>
                        <ul class="list-group shadow">
                            @foreach ($products as $index => $product)
                                @if($distributor->product->contains($product->id))
                                <li class="list-group-item mb-2">
                                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                        <div class="media-body order-2 order-lg-1">
                                            <h5 class="mt-0 font-weight-bold mb-2">{{ $product->title }}</h5>
                                            <p class="font-italic text-muted mb-0 small">{{ $product->description }}</p>
                                            <div class="d-flex align-items-center justify-content-between mt-1">
                                                <h6 class="font-weight-bold my-2">Rp. {{ number_format($product->price, 2, ',', '.') }}</h6>
                                                <div class="d-flex">
                                                    <button type="button" class="btn btn-sm p-1 mr-2 btn-success" id="order{{$index-1}}">Pesan</button>
                                                    <div id="input{{$index-1}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($product->image)
                                            @if(file_exists(public_path(). '/storage/product/'. $product->image))
                                                <img src="{{asset('storage/product/'. $product->image)}}" width="120" height="100" class="ml-lg-5 order-1 order-lg-2" />
                                            @else
                                                <img src="{{asset('assets/images/nopic.jpg')}}" width="120" height="100" class="ml-lg-5 order-1 order-lg-2" /> 
                                            @endif
                                        @else
                                            <img src="{{asset('assets/images/nopic.jpg')}}" width="120" height="100" class="ml-lg-5 order-1 order-lg-2" /> 
                                        @endif
                                    </div>
                                </li>
                                @endif 
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success" type="submit">Lanjut</button>
                    <a href="{{ route('transaction.index') }}" class="btn btn-danger">Batal</a>
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
        var distributor = {!! json_encode($distributor, JSON_HEX_TAG) !!};
        $.each(distributor.product, function( i, product ) {
            $('#order' + i).click(function (e) {
                $('#input' + i).append('<input class="form-check-input" type="hidden" name="product_id[]" id="product_id' + i + '" value=' + product.id + ' style="display:none;"><input type="number" class="form-control form-control-sm col-5" id="qty' + i + '" name="qty[]" style="display:none;" disabled required min="1">');
                if ($('#qty' + i).prop('disabled')) {
                    $('#qty' + i).prop('disabled', false);
                    $('#order' + i).html('Batal');
                    $('#order' + i).removeClass('btn-success');
                    $('#order' + i).addClass('btn-danger');
                } 
                else {
                    $('#qty' + i).prop('disabled', true);
                    $('#order' + i).html('Pesan');
                    $('#order' + i).removeClass('btn-danger');
                    $('#order' + i).addClass('btn-success');
                    $('#input' + i).html('');
                }
                $('#qty' + i).toggle('show');
                $('#product_id' + i).toggle('show');
            });  
        });
    </script>
@endsection