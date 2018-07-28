<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Product;

class ProductsController extends Controller
{
   public function index()
   {
     $products = Product::all();
     return response()->json($products);
   }

   public function show($id)
   {
       $product = Product::find($id);
       if(!$product){
         return response()->json([
             'message'   => 'Record not found',
         ], 404);
       }
       return response()->json($product, 200);
   }

   public function store(StoreProduct $request)
   {
       $product = new Product();

        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->save();
        
       return response()->json($product, 201);
   }

   public function update(Request $request, $code)
   {
     $product = Product::where('code',$code);

      if(!$product) {
          return response()->json([
              'message'   => 'Record not found',
          ], 404);
      }
      $product->update($request->all());

      return response()->json($product);
   }

   public function destroy($id)
   {
     $product = Product::find($id);
        if(!$product) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $product->delete();
   }
}
