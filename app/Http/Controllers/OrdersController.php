<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderItem;
use App\Consumer;
use App\Product;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\StoreOrder;
use App\Search\OrderSearch;

class OrdersController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
      return $this->orderRepository->allOrders();
    }

    public function store(Request $request, $number = '')
    {
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
      //Lógica:  novo pedido- posso ter uma função que resolva apenas peço um novo number
      $order->number        = $this->orderRepository->NewNumberOrder();
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

    public function destroy($number)
    {
      return $this->orderRepository->deleteOrder($number);
    }

    public function search(Request $request)
    {
       return OrderSearch::apply($request);
    }

}
