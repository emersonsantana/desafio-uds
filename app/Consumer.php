<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Uuid\UuidTraits as Uuid;

class Consumer extends Model
{
  use Uuid;

  public $incrementing = false;

  protected $fillable =[
    'name', 'cpf', 'birth_date',
  ];
}
