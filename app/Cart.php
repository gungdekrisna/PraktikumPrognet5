<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cart extends Model
{
    public function product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }
}
