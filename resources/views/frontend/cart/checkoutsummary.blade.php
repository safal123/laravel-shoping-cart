@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3 text-navy">Billing address</h4>
                    <hr>
                    <form action="{{ route('payment') }}"
                        method="POST" id="payment-form">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" name="first_name" class="form-control" id="firstName">
                        <!-- <div class="invalid-feedback">
                            Valid first name is required.
                        </div> -->
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" name="last_name" id="lastName">
                        <!-- <div class="invalid-feedback">
                            Valid last name is required.
                        </div> -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="billing_email">Billing Email</label>
                        <input type="email" name="billing_email" class="form-control" id="email" placeholder="you@example.com">
                        <!-- <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                        </div> -->
                    </div>

                    <div class="mb-3">
                        <label for="address">Billing Address</label>
                        <input type="text" name="billing_address" class="form-control" id="address" placeholder="1234 Main St">
                        <!-- <div class="invalid-feedback">
                        Please enter your shipping address.
                        </div> -->
                    </div>
                    <div class="mb-3">
                        <label for="address">Phone</label>
                        <input type="text" name="billing_phone"  class="form-control" id="phone">
                    </div>

                    <h4 class="mb-3 text-navy">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                        <label class="custom-control-label" for="credit">Card</label>
                        </div>
                        <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                        <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="address">Name on Card</label>
                        <input type="text" name="billing_name_on_card"  class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    </div>
                    <button class="btn btn-outline-dark">Submit Payment</button>
                    </form>
                    </div>
                </div>
        </div>
        <div class="col-md-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-navy">Your cart</span>
            <span class="badge badge-secondary badge-pill">{{ Cart::content()->count() }} items.</span>
            </h4>
            <ul class="list-group mb-3">
            @foreach(Cart::content() as $item)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">{{ $item->name }}</h6>
                    <small class="text-muted">{{ $item->description }}</small>
                </div>
                <span class="text-muted">
                    {{ $item->price }} * {{ $item->qty }} =
                    ${{ ($item->price)* ($item->qty) }}
                </span>
                </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                <span>Total (AUD)</span>
                <strong>{{ Cart::total() }}</strong>
                </li>
            </ul>
            <form class="card p-2">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo code">
                <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@section('extrajs')
  <script src="{{ asset('js/stripe.js') }}" defer></script>
@endsection
