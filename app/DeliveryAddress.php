<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    //
    protected $table = 'delivery_address';

    protected $fillable = ['address',
        'order_id',
        'city',
        'postcode',
        'state',
        'phone',
        'email',
        'name'];

    public function Order()
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }

    public function State()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }
}