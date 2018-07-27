<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
{
    public function index()
    {
      $orders = Order::all();
      return response()->json($orders);
    }

    public function destroy($number)
    {
      $order = Order::where('number', $number);

      if(!$order){
        return response()->json([
            'message'   => 'Record not found',
        ], 404);
      }

      $order->delete();

    }
}
