<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function rolePrice()
    {
        $this->hasMany(RolePrice::class, 'role_id', 'id');
    }
}