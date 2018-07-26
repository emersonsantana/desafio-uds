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
}
