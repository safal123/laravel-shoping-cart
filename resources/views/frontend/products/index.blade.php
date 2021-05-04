@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-4 mt-2 mb-2 ">
        <h3 class="text-navy">All Products</h3>
    </div>
    <div class="col">
        <div class="row ">
            @foreach($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <img class="card-img-top" height="200" width="200" src="{{ url('storage/'.$product->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><a href="product.html" title="View Product">{{ $product->name }}</a></h4>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="row">
                            <div class="col">
                                <p class="btn btn-danger btn-block">{{ $product->price }}.00 $</p>
                            </div>
                            <div class="col">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="qty" value="1" />
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                    <button class="btn btn-info btn-block">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- <div class="container">
    <div class="row">
        <div class="col">
            @foreach($products as $product)
                <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">{{ $product->name }}</a></h4>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">{{ $product->price }} $</p>
                                </div>
                                <div class="col">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="qty" value="1" />
                                        <input type="hidden"
                                            name="product_id" value="{{ $product->id }}"/>
                                        <button class="btn btn-info btn-block">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div
            @endforeach
        </div
    </div>
</div> -->

{{ $products->links() }}
@endsection