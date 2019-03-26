<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'dob', 'date_purchased', 'nric', 'address',
    ];
}