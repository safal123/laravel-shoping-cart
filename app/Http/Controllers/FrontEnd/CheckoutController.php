<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;
use Cart;
use Session;
use App\Order;

class CheckoutController extends Controller
{
  public function __construct()
   {
      $this->middleware('isCartEmpty');
   }

  public function index()
  {
    return view('frontend.cart.checkoutsummary');
  }

  public function payment(Request $request)
  {
    try{
      $charge = Stripe::charges()->create([
        'amount' => Cart::total(),
        'currency' => 'AUD',
        'source' => $request->stripeToken,
        'description' => 'Order',
        'receipt_email' => 'pokharelsafal66@gmail.com',
        'metadata' => [
        ],
      ]);

      //Insert data into orders table
      
      $order = Order::create([
        'user_id' => auth()->user() ? auth()->user()->id: null,
        'billing_email' => $request->billing_email,
        'billing_name' => $request->first_name. $request->last_name,
        'billing_address' => $request->billing_address,
        'billing_phone' => $request->billing_phone,
        'billing_name_on_card' => $request->billing_name_on_card,
        'billing_discount_code' =>'ABCD',
        'billing_discount' => Cart::discount(),
        'billing_subtotal' => Cart::subtotal(),
        'billing_tax' =>Cart::tax(),
        'billing_total' =>Cart::total(),
        'payment_method' =>'Stripe',
        'shipped' =>false,
        'error' => null,
      ]);
      //dd($order);
      //Insert into oerder_product table
      //success
      Cart::destroy();
      Session::flash('success', 'Purchase successfull.');
      return redirect()->back();
    } catch(Exception $e){

    }
  }
}
