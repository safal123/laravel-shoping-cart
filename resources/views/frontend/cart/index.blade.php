@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-9">
        <div class="ibox">
          <div class="ibox-title mb-2">
            <span class="pull-right text-navy">(<strong>{{ $cartCount }}</strong>) items
            <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Clear Cart</a>
          </span>
            @if($count=='true')
              <h1 class="text-navy">Items on your cart</h1>
            @else 
              <h5>Cart is empty.</h5>
            @endif
            
          </div>
          <div class="ibox-content">
              <div class="table-responsive">
                <table class="table shoping-cart-table" border="1">
                  <tbody>
                  @foreach($cart as $product)
                  <tr class="">
                    <td width="90">
                        <div class="cart-product-imitation">
                          <img src="" alt="">
                        </div>
                    </td>
                    <td class="desc">
                        <h3>
                          <a href="#" class="text-navy">
                            {{ $product->name }}
                          </a>
                        </h3>
                        <p class="small">
                          <!-- Page when looking at its layout. The point of using Lorem Ipsum is -->
                        </p>
                        <div class="m-t-sm">
                          <div class="btn-group">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                              <i class="fa fa-gift"></i> Add gift package
                            </a>
                            <a href="{{ route('cart.delete', ['id' => $product->rowId])}}" class="btn btn-outline-danger btn-sm">
                              <i class="fa fa-trash"></i> Remove item
                            </a>
                          </div>
                        </div>
                    </td>
                    <td >
                        ${{ $product->price }}
                    </td>
                    <td>
                      <div class="btn-group">
                      <a href="{{route('cart.increment', ['id' => $product->rowId, 'qty'=>$product->qty])}}" class="btn btn-sm btn-outline-info">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                      </a>
                      <input type="text" value="{{ $product->qty }}" class="item-quantity bg-info" disabled>
                      <a href="{{route('cart.decrement', ['id' => $product->rowId, 'qty'=>$product->qty])}}" class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                      </a>
                      </div>
                    </td>
                    <td>
                      <h4>
                        ${{ ($product->price)*($product->qty) }}
                      </h4>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
          </div>
          <div class="btn-group ibox-content">
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
              <i class="fa fa-arrow-left"></i> Continue shopping
            </a>
            <a href="{{ route('cart.checkout') }}" class="btn btn-outline-primary pull-right">
              <i class="fa fa fa-shopping-cart"></i> Checkout
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
          <div class="ibox">
              <div class="ibox-title">
                  <h5>Cart Summary</h5>
              </div>
              <div class="ibox-content">
                  <table class="table table-dark">
                    <tr>
                      <td>Price:</td>
                      <td>${{ $subTotal }}</td>
                    </tr>
                    <tr>
                      <td>Tax:</td>
                      <td>${{ $tax }}</td>
                    </tr>
                    <tr class="bg-info">
                      <td>Total:</td>
                      <td>${{ $total }}</td>
                    </tr>
                  </table>
                  <!-- <h2 class="font-bold">
                      {{ Cart::total() }}
                  </h2> -->

                  <hr>
                  <!-- <span class="text-muted small">
                      *For United States, France and Germany applicable sales tax will be applied
                  </span> -->
                  <div class="m-t-sm">
                      <div class="btn-group">
                        <a href="{{ route('cart.checkout') }}" class="btn btn-outline-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
                        <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger btn-sm"> Cancel</a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="ibox">
              <div class="ibox-title">
                  <h5>Support</h5>
              </div>
              <div class="ibox-content text-center">
                  <h3><i class="fa fa-phone"></i> +43 100 783 001</h3>
                  <span class="small">
                      Please contact with us if you have any questions. We are avalible 24h.
                  </span>
              </div>
          </div>

          <!-- <div class="ibox">
            <div class="ibox-content">
                <p class="font-bold">
                Other products you may be interested
                </p>
                <hr>
                <div>
                    <a href="#" class="product-name"> Product 1</a>
                    <div class="small m-t-xs">
                        Many desktop publishing packages and web page editors now.
                    </div>
                    <div class="m-t text-righ">

                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
                <hr>
                <div>
                    <a href="#" class="product-name"> Product 2</a>
                    <div class="small m-t-xs">
                        Many desktop publishing packages and web page editors now.
                    </div>
                    <div class="m-t text-righ">

                        <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                    </div>
                </div>
            </div>
          </div> -->
      </div>
      </div>
    </div>
  </div>
@endsection
