<?php

Route::redirect('/home', '/');

Route::get('/react/{path?}/', [
    'uses' => 'ReactController@index',
    'as' => 'react',
])->where('path', '.*');

Auth::routes(['verify' => 'true']);

Route::get('/', 'HomeController@index')
    ->name('home')
    ->middleware('verified');

Route::resource('/products', 'Frontend\ProductsController');

Route::get('/cart', [
    'uses' => 'FrontEnd\CartController@view_cart',
    'as' => 'cart.view',
]);

Route::post('/cart', [
    'uses' => 'FrontEnd\CartController@add_to_cart',
    'as' => 'cart.add',
]);

Route::get('/cart/delete/{id}', [
    'uses' => 'FrontEnd\CartController@cart_item_delete',
    'as' => 'cart.delete',
]);

Route::get('/cart-clear', [
    'uses' => 'FrontEnd\CartController@cart_clear',
    'as' => 'cart.clear',
]);

Route::get('/cart/order', [
    'uses' => 'FrontEnd\CartController@cart_checkout',
    'as' => 'cart.checkout',
]);

Route::get('/cart/checkout', [
    'uses' => 'FrontEnd\CheckoutController@index',
    'as' => 'cart.confirm',
]);

Route::post('/cart/checkout', [
    'uses' => 'FrontEnd\CheckoutController@payment',
    'as' => 'payment',
]);

Route::get('/cart/increment/{id}/{qty}', [
    'uses' => 'FrontEnd\CartController@increment',
    'as' => 'cart.increment',
]);

Route::get('/cart/decrement/{id}/{qty}', [
    'uses' => 'FrontEnd\CartController@decrement',
    'as' => 'cart.decrement',
]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::get('/products', 'ProductController@index')->name('admin.products');
    Route::get('/products/create', 'ProductController@create')->name('admin.products.create');
    Route::post('/products/create', 'ProductController@store')->name('admin.products.store');
    Route::get('/orders', 'OrderController@index')->name('admin.orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('admin.orders.show');
    Route::get('/categories', 'CategoryController@index')->name('admin.categories.index');
    Route::post('/categories/{id}', 'CategoryController@update');
    Route::delete('/categories/{id}', 'CategoryController@destroy');
});
