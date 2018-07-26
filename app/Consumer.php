<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
  protected $fillable =[
    'name', 'cpf', 'birth_date',
  ];
}
