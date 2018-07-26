<?php

Route::group(array('prefix' => 'api'), function()
{

  Route::get('/', function () {
      return response()->json(['message' => 'API', 'status' => 'Connected']);;
  });

      Route::resource('products', 'ProductsController');
      Route::resource('consumers', 'ConsumersController');
      Route::resource('orders', 'OrdersController');
  });

Route::get('/', function () {
    return redirect('api');
});
