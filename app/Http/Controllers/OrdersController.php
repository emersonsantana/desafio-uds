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
      $consumer = Consumer::where('cpf',$request->cpf)->get()->first();
      $product  = Product::where('code', $request->product_code)->get()->first();

      if(isset($consumer) && isset($product))
      {
        $order    = new Order();
        $total_item = $product->price * $request->qtd;
        //com desconto
        $discount = ( $total_item/100 ) * $request->discount_percentage;
        $total_item = round( $total_item - $discount, 2 );
        if($number)
        {
          $order = Order::where('number', $number)->get()->first();
          //Atualiza o $total e salva o item do Pedido
          if(!isset($order)) //caso seja passado um number que não exista
              return response()->json(['message'   => 'Record not found',], 404);
          $total_item = $order->total + $total_item;
        }
        //Função NewNumberOrder trata o number correto
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

      return response()->json([
					'message'   => 'Record not found',
			], 404);
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
