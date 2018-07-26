<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'consumer_id', 'number', 'emission_date', 'total',
    ];

    public function customers()
    {
        return $this->belongsTo('App\Consumer', 'consumer_id');
    }
}
