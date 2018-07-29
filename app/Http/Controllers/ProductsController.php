<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Product;
use App\Http\Repositories\ProductRepository;
use App\Search\ProductSearch;

class ProductsController extends Controller
{
  private $productRepository;

  public function __construct(ProductRepository $productRepository)
  {
      $this->productRepository = $productRepository;
  }

   public function index()
   {
     return $this->productRepository->allProducts();
   }

   public function show($code)
   {
     return $this->productRepository->show($code);
   }

   public function store(StoreProduct $request)
   {
     return $this->productRepository->store($request);
   }

   public function update(UpdateProduct $request, $code)
   {
     return $this->productRepository->update($request, $code);
   }

   public function destroy($code)
   {
      return $this->productRepository->delete($code);
   }
   public function search(Request $request)
   {
      return ProductSearch::apply($request);
   }
}
