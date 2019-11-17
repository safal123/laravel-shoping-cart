<?php

//use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/products', 'Api\ProductController@index');

Route::group(['middleware' => 'api-header'], function () {
    Route::post('/login',[
        'as' => 'login.login',
        'uses' => 'Api\Auth\UserController@login',
    ]);
  Route::post('/register',[
    'as' => 'register.register',
    'uses' => 'Api\Auth\UserController@register',
  ]);
});

Route::post('/logout',[
  'as' => 'logout.logout',
  'uses' => 'Api\Auth\UserController@logout',
]);

Route::group([
  'middleware' => ['jwt.auth'],
  'namespace' => 'Api'], 
  function () 
    {
        Route::get('/orders', 'OrderController@index');
        Route::get('/refresh', 'Auth\UserController@refresh');
        Route::post('/checkout', 'StripeCheckoutController@checkout');
    }
);

