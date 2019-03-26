<?php

namespace App;

use App\ProductTracker;
use Illuminate\Database\Eloquent\Model;

class ProductTrackerItem extends Model
{
    //
    public function ProductTracker()
    {
        return $this->hasOne(ProductTracker::class, 'id', 'tracker_id');
    }
}