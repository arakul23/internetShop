<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class brand extends Model
{
    public $timestamps = false;
    protected $table = 'brand';
    protected $primaryKey = 'id';


    function products()
    {
        return $this->hasMany('App\Models\product', 'brand', 'id');

    }


    function productByBrandName($brandName)
    {
        $products = array();
        $result = Brand::with('products')->where('name', $brandName)->get();;
        foreach ($result as $item) {
            $products[] =  $item['products'];
}

        return $result;
    }

}
