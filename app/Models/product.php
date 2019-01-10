<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class product extends Model
{

    public $rules = [
        'prodName' => 'required',
    ];

    protected $fillable = [
        'name', 'price', 'category',
    ];

    public $table = 'product';
    protected $guarded = [
        'id',
    ];

    function lastProduct()
    {
        $objImage = new images();
        $product = DB::table('product')->orderBy('id', 'desc')->limit(5)->get();
        $images = $objImage->images();
        foreach ($product as $prod) {
            foreach ($images as $image) {
                if ($prod->id === $image->id_product) {
                    $prod->image = $image->url;
                }
            }
        }
        return $product;
    }

    function categoryProduct($category)
    {
        $objImage = new images();
        $objProperties = new properties();
        $product = DB::table('product')->where("category", $category)->paginate(20);
        $images = $objImage->images();
        $filter = $objProperties->filter($category);
        foreach ($product as $prod) {
            foreach ($images as $image) {
                if ($prod->id === $image->id_product) {
                    $prod->image = $image->url;
                }
            }
        }

        return array("product" => $product, "filter" => $filter);

    }

    function fullInfo($request)
    {

        $id = $request->idVal;

        $product = DB::table('product')->select("id", "name", "price", 'description')->where("id", $id)->get();

        $char = DB::table('product')->join('property_product', 'product.id', '=', 'id_product')->join('properties', 'properties.id', '=', 'property_product.id_property')->
        select('properties.name', 'property_product.value')->where("product.id", $id)->get();
        $properties = json_decode($char, true);
        return array("product" => $product, "properties" => $properties);
    }


    function search($request)
    {
        $objImage = new images();

        $query = $request->searchQuery;
        $product = DB::table('product')->where('name', 'LIKE', '%' . $query . '%')->get();
        $images = $objImage->images();
        foreach ($product as $prod) {
            foreach ($images as $image) {
                if ($prod->id === $image->id_product) {
                    $prod->image = $image->url;
                }
            }

        }

        return $product;

    }
}
