<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Uuid\UuidTraits as Uuid;

class OrderItem extends Model
{
    use Uuid;
    public $incrementing = false;

    protected $fillable = [
        'order_id','qtd', 'unit_price', 'discount_percentage', 'total',
    ];
    public function orders()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
