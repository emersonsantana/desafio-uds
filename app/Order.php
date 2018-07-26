<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Uuid\UuidTraits as Uuid;

class Order extends Model
{
  use Uuid;

  public $incrementing = false;
  
    protected $fillable = [
        'consumer_id', 'number', 'emission_date', 'total',
    ];

    public function customers()
    {
        return $this->belongsTo('App\Consumer', 'consumer_id');
    }
}
