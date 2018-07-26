<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Uuid\UuidTraits as Uuid;

class Product extends Model
{
    use Uuid;

    public $incrementing = false;

    protected $fillable =[
      'code', 'name', 'price',
    ];
}
