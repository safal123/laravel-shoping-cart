<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;
use Cart;

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
      //success
      Cart::destroy();
      return redirect()->back();
    } catch(Exception $e){

    }
  }
}
