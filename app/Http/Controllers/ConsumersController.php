<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreConsumer;
use App\Consumer;

class ConsumersController extends Controller
{
  public function index()
  {
    $consumer = Consumer::all();
    return response()->json($consumer);
  }

  public function show($id)
  {
      $consumer = Consumer::find($id);
      if(!$consumer){
        return response()->json([
            'message'   => 'Record not found',
        ], 404);
      }
      return response()->json($consumer, 200);
  }

  public function store(StoreConsumer $request)
  {
      $consumer = new Consumer();
      $consumer->name       = $request->name;
      $consumer->cpf        = $request->cpf;
      $consumer->birth_date = $request->birth_date;

      $consumer->save();

      return response()->json($consumer, 201);
  }

  public function update(Request $request, $cpf)
  {
    $consumer = Consumer::where('cpf', $cpf);

     if(!$consumer) {
         return response()->json([
             'message'   => 'Record not found',
         ], 404);
     }
     $consumer->update($request->all());

     return response()->json($consumer);
  }

  public function destroy($cpf)
  {
    $consumer = Consumer::where('cpf', $cpf);
       if(!$consumer) {
           return response()->json([
               'message'   => 'Record not found',
           ], 404);
       }
       $consumer->delete();
   return response()->json(202);
  }
}
