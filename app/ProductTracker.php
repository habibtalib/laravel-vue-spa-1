<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTracker extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'status', 'total', 'buyer_id', 'tracking_number', 'serial_number', 'end_serial_number', 'buyer_name', 'buyer_phone', 'buyer_address', 'product_id'];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Buyer()
    {
        return $this->hasOne(User::class, 'id', 'buyer_id');
    }

    public function Product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function Item()
    {
        return $this->HasMany(ProductTrackerItem::class, 'tracker_id');
    }
}