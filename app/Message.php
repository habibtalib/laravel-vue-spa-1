<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'image', 'price', 'price_master_stockist', 'price_stockist', 'price_agent_ruby', 'price_agent_perl', 'price_dropship', 'quantity_master_stockist', 'quantity_stockist', 'quantity_agent_ruby', 'quantity_agent_perl', 'quantity_dropship', 'weight'];

    protected $dates = ['deleted_at'];

    public function rolePrice()
    {
        return $this->hasMany(RolePrice::class, 'product_id', 'id');
    }
}