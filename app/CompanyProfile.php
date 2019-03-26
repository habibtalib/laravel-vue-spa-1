<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CompanyProfile extends Model
{
    protected $fillable = [
        'company_name', 'company_reg_no', 'phone_no', 'gst_no', 'address', 'city', 'postcode', 'state', 'bank_name' , 'acc_name' , 'email' , 'acc_no'
    ];

    public function State(){
        return $this->hasOne(State::class, 'id', 'state');
    }
}
