@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="ibox">
          <div class="ibox-title mb-2">
            <div class="d-flex">
              <div>
                <h1 class="center">Your order summary
                </h1>
              </div>
              <div class=" ml-auto">
                <div class="btn-group">
                  <a href="{{ route('cart.view') }}" class="btn btn-outline-info">
                    <i class="fa fa fa-shopping-cart"></i>
                    View Cart
                  </a>
                  <a href="{{ route('cart.clear') }}" class="btn btn-outline-danger">
                    <i class="fa fa-trash"></i>
                    Clear Cart
                  </a>
                </div>
              </div>

            </div>
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach(Cart::content() as $item)
                    <tr>
                      <td>{{$item->name}}</td>
                      <td>{{$item->qty}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->total}}</td>
                    </tr>
                  @endforeach
                  <tr colspan="4" class="bg-info">
                    <td></td>
                    <td></td>
                    <td>Total Price</td>
                    <td>
                      {{ Cart::total() }}
                    </td>

                  </tr>
                </tbody>
              </table>
          </div>
      </div>
      <div class="btn-group footer">
        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
          <i class="fa fa-arrow-left"></i> Continue shopping
        </a>
        <a href="{{ route('cart.confirm') }}" class="btn btn-outline-info">
          <i class="fa fa-credit-card" aria-hidden="true"></i>
          Proceed to checkout
        </a>
      </div>

    </div>
  </div>
@endsection
