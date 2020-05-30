<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    public function product(){
    	return $this->hasOne('App\Product','id','product_id');
    }

    public function user(){
    	return $this->hasOne('App\User','id','user_id');
    }

    public function response()
    {
        return $this->hasMany('App\Response', 'id', 'review_id');
    }
}