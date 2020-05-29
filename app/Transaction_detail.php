<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
	protected $table='transaction_details';

	public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
