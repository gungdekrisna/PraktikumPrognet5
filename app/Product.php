<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

	use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'product_name', 'price', 'description','product_rate','stock','weight',
    ];

    protected $dates = ['deleted_at'];

    public function product_image()
    {
        return $this->hasMany('App\Product_image');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\Transaction_detail');
    }
}
