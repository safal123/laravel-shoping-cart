@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        @foreach($products as $product)
          <div class="col-sm-3 mt-1">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="/img/2.jpg" alt="Card image cap">
              <div class="card-body">
                <hr>
                <h5 class="card-title">{{ $product->name }}</h5>
                <!-- <p class="card-text">{{str_limit($product->description, 50)}} <a href="{{ route('products.show', [$product->id] ) }}" class="">...Read more</a></p> -->
                <div class="row">
                  <div class="col-md-6 mt-2">
                    AU<i class="fa fa-dollar"></i> {{ $product->price }}
                  </div>
                  <div class="col-md-6">
                    <form action="{{ route('cart.add') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="qty" value="1" />
                      <input type="hidden" 
                        name="product_id" value="{{ $product->id }}"/> 
                      <button class="btn btn-sm btn-info" onClick="addToCart()">
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
      <!-- Links for pagination and going to edit on vendor publish
      later to modify the default layout of pagination of bootstrap -->
      <!-- {{ $products->links() }} -->
    </div>
  </div>
</div>
@endsection

@section('extrajs')
  <script>
    function addToCart() {
      console.log('hello');
      $.ajax({
        type:'POST',
        url:'/cart'
      });
    }
  </script>
@endsection
