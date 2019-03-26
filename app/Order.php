<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'status', 'total', 'bill_id', 'collection_id', 'courier_id', 'tracking_number', 'note', 'postage'];

    public function Status()
    {
        return $this->hasOne(OrderStatus::class, 'id', 'status');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Courier()
    {
        return $this->hasOne(Courier::class, 'id', 'courier_id');
    }

    public function Item()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function Delivery()
    {
        return $this->hasOne(DeliveryAddress::class, 'order_id');
    }
}