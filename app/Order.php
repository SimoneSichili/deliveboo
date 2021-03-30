<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_phone',
        'notes',
        'order_status',
        'total_price'
    ];
    public function dishes() {
        return $this->belongsToMany('App\Dish');
    }
}
