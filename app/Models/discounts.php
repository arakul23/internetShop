<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class discounts extends Model
{
    public $timestamps = false;


    function products()
    {

        return $this->belongsTo('App\Models\product', 'product_id', 'id');

    }

    function images()
    {

        return $this->belongsTo('App\Models\images', 'product_id', 'product_id');

    }

    function discountProds()
    {
        $today = date('Y-m-d');
        return Discounts::with('products', 'images')->where('dateStart', '<=', $today)->where('dateFinish', '>=', $today)->get();

    }


}
