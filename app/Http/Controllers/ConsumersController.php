<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreConsumer;
use App\Http\Requests\UpdateConsumer;
use App\Consumer;
use App\Http\Repositories\ConsumerRepository;

class ConsumersController extends Controller
{
  private $consumerRepository;

  public function __construct(ConsumerRepository $consumerRepository)
  {
      $this->consumerRepository = $consumerRepository;
  }

  public function index()
  {
    return $this->consumerRepository->allConsumers();
  }

  public function show($cpf)
  {
      return $this->consumerRepository->show($cpf);
  }

  public function store(StoreConsumer $request)
  {
      return $this->consumerRepository->store($request);
  }

  public function update(UpdateConsumer $request, $cpf)
  {
      return $this->consumerRepository->update($request, $cpf);
  }

  public function destroy($cpf)
  {
      return $this->consumerRepository->delete($cpf);
  }
}
