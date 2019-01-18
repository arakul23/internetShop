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


    function allProd()
    {
    $product = DB::table('product')->get();
    return $product;
    }

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
        $objProperties = new filter();
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


function byId($id){

   $result =  DB::table('product')->select("id", "name", "price", 'description', 'brand')->where("id", $id)->get();
 
   return $result;
}


function cartProduct($request){

$objImage = new images();
$images = $objImage->images();
    if (empty(session("product"))) {
            $productArr = array();
            return view('cartProduct');

        } 
        else 
            $productArr = session("product");
        
        foreach ($productArr as $array) {
            $id = $array['id'];
            $product[] = $this->byId($id);

        }

         foreach ($product as $prod) {

                foreach ($images as $image) {
                if ($prod[0]->id === $image->id_product) {
                    $prod[0]->image = $image->url;
                }
            }

            foreach ($request->session()->get('product') as $sessionProd) {

                if ($prod[0]->id == $sessionProd['id']) {
                    $prod[0]->quantity = $sessionProd['quantity'];
                }


            }
        }






return $product;

    }


}
