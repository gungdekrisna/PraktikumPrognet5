<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
	protected $table='response';

    public function product_review(){
    	return $this->hasOne('App\Product_review','id','review_id');
    }

    public function admin(){
    	return $this->hasOne('App\Admin','id','admin_id');
    }
}