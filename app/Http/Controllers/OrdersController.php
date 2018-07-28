<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Consumer;
use App\Product;
use App\Http\Requests\StoreOrder;

class OrdersController extends Controller
{
    public function index()
    {
      $orders = Order::all();
      return response()->json($orders);
    }
    public function store(Request $request, $number = '')
    {//vem cpf, cod prod, quanti, desconto Caso tenho number adicionar ao pedido tal
      $consumer = Consumer::where('cpf',$request->cpf)->get();

      $product  = Product::where('code', $request->product_code)->first();
      $order    = new Order();
      $total_item = $product->price * $request->qtd;
      //com desconto
      $discount = ( $total_item/100 ) * $request->discount_percentage;
      $total_item = round( $total_item - $discount, 2 );
      if($number)
      {
        $order = Order::where('number', $number)->get()->first();
        //Atualiza o $total e salva o item do Pedido
        $total_item = $order->total + $total_item;
        $item->order_id = $order->id;
      }
      $order->number        = 1; //valor incremnetal
      $order->emission_date = date('Y-m-d');//$request->emission_date;
      $order->consumer_id   = $consumer->first()->id;
      $order->total         = $total_item;
      //Item do pedido
      $item = new OrderItem();


      $item->product_id = $product->id;
      $item->qtd = $request->qtd;
      $item->unit_price = $product->price;
      $item->discount_percentage = $request->discount_percentage;
      $item->total = $total_item;
      $order->save();
$item->order_id = $order->id;
      $item->save();

      return response()->json($item);
    }
    public function show($id)
    {

    }
    public function update($id)
    {

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
