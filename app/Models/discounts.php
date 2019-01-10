<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class discounts extends Model
{
    public $timestamps = false;

    public function discounts(){
        $today = date('Y-m-d');
        $objImages = new images();
        $images = $objImages->images();
        $product = DB::table('product')->join('discounts', 'product.id', '=', 'id_product')->
        select('product.*', 'discounts.percent', 'discounts.id', 'discounts.id_product')->where('discounts.dateStart', '<=', $today)->where('discounts.dateFinish', '>=', $today)->get();
        foreach ($product as $prod) {
            foreach ($images as $img){
                if($prod->id == $img->id_product)
                    $prod->image = $img->url;
            }
            $prod->discountPrice = $prod->price - (($prod->price * ($prod->percent / 100)));
        }


        return $product;

    }


}
