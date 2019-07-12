<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::view('/react/{path?}', 'react.layout');
Route::get('/react/{path?}',[
  'uses' => 'ReactController@index',
  'as' => 'react'
]);
Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
Route::resource('products', 'Frontend\ProductsController');

Route::get('/cart',[
  'uses' => 'FrontEnd\CartController@view_cart',
  'as' => 'cart.view'
]);

Route::post('/cart',[
  'uses' => 'FrontEnd\CartController@add_to_cart',
  'as' => 'cart.add'
]);

Route::get('/cart/delete/{id}',[
  'uses' => 'FrontEnd\CartController@cart_item_delete',
  'as' => 'cart.delete'
]);

Route::get('/cart-clear',[
  'uses' => 'FrontEnd\CartController@cart_clear',
  'as' => 'cart.clear'
]);

Route::get('/cart/order',[
  'uses' => 'FrontEnd\CartController@cart_checkout',
  'as' => 'cart.checkout'
]);

Route::get('/cart/checkout',[
  'uses' => 'FrontEnd\CheckoutController@index',
  'as' => 'cart.confirm'
]);

Route::post('/cart/checkout',[
  'uses' => 'FrontEnd\CheckoutController@payment',
  'as' => 'payment'
]);

Route::get('/cart/increment/{id}/{qty}',[
  'uses' => 'FrontEnd\CartController@increment',
  'as' => 'cart.increment'
]);

Route::get('/cart/decrement/{id}/{qty}',[
  'uses' => 'FrontEnd\CartController@decrement',
  'as' => 'cart.decrement'
]);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
