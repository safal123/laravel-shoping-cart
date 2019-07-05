<?php

namespace App\Http\Controllers\FrontEnd;

use Cart;
use Session;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
  //middleware to check is cart is empty
  public function __construct()
   {
      $this->middleware('isCartEmpty')->except('add_to_cart');
   }

  public function add_to_cart(Request $request)
  {
    $product = Product::find($request->product_id);
    if($product) {
      $cart = Cart::add([
      'id' => $product->id,
      'name' => $product->name,
      'qty' => $request->qty,
      'price' => $product->price,
      'weight' => $product->is_active,
      ]);
      Cart::associate($cart->rowId, 'App\Product');
      $notification = array(
        'message' => 'Item added to cart.',
        'alert-type' => 'success'
      ); 
      //Session::flash('success', 'Item added to cart.'); 
      return redirect()->route('cart.view')->with($notification);
    }
    
  }

  public function view_cart()
  {
    $tax = Cart::tax();
    $subTotal = Cart::subtotal();
    $total = Cart::total();
    $cartCount = Cart::content()->count();
    $count = $cartCount > 0 ? 'true' : 'false';
    $cart = Cart::content();
    return view('frontend.cart.index',compact([
      'cart',
      'count',
      'tax',
      'subTotal',
      'total',
      'cartCount'
    ]));
  }

  public function cart_item_delete($id) 
  {
    Cart::remove($id);
    //Session::flash('alert', 'Item removed from successfully.');
    $notification = array(
      'message' => 'Item removed successfully.',
      'alert-type' => 'success'
    ); 
    return redirect()->back()->with($notification);
  }

  public function cart_clear() 
  {
    Cart::destroy();
    //Session::flash('alert', 'Cart is empty.');
    $notification = array(
        'message' => 'Cart is cleared successfully.',
        'alert-type' => 'error'
    );
    return redirect()->route('products.index')->with($notification);
  }

  public function cart_checkout() 
  {
    return view('frontend.cart.checkout');
  }

  public function increment($id, $qty)
  {
    Cart::update($id, $qty + 1);
    $notification = array(
      'message' => 'Item added to cart.',
      'alert-type' => 'success'
      ); 
    //Session::flash('success', 'Cart updated successfully.');
    return redirect()->back()->with($notification);
  }

  public function decrement($id, $qty)
  {
    $cart = Cart::content();
    Cart::update($id, $qty - 1);
    $notification = array(
      'message' => 'Item removed from cart.',
      'alert-type' => 'warning'
      ); 
    //Session::flash('success', 'Cart updated successfully.');
    return redirect()->back()->with($notification);
  }

}
