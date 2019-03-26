<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RolePrice extends Model
{

    protected $fillable = [
        'role_id', 'product_id', 'price', 'quantity'
    ];

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
