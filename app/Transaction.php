<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function courier(){
    	return $this->hasOne('App\Courier','id','courier_id');
    }
}