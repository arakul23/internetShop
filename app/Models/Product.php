<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
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

    protected $primaryKey = 'id';

    public function properties()
    {
        return $this->belongsToMany('App\Models\properties',
            'property_product',
            'id_product',
            'id_property')->withPivot('property_value');
    }

    function brand()
    {
        return $this->hasOne('App\Models\brand', 'id', 'brand');

    }


    function category()
    {
        return $this->hasOne('App\Models\brand', 'id', 'brand');

    }

    function images()
    {

        return $this->hasMany('App\Models\images');

    }


    function discounts()
    {

        return $this->hasMany('App\Models\discounts');

    }

    function RAM()
    {

        $result = Product::query()->whereHas('properties', function ($q) {
            $q->where('property_product.property_value', '2 ГБ')->where('name', 'ОЗУ');
        })->get();

        foreach ($result as $role) {
            echo $role;
            //$propertyProduct = DB::table('property_product')
        }

        die();
    }

    function allProd($pagination)
    {

        if ($pagination === true)
            $product = Product::with('brand', 'images', 'discounts')->paginate(20);
        else
            $product = Product::with('brand', 'images', 'discounts')->get();


        return $product;
    }

    function lastProduct()
    {
        $product = Product::with('brand', 'images')->limit(5)->get();
        $product[0]->images = json_decode($product[0]->images);

        return $product;
    }




    function categoryProduct($category)
    {

        $objProperties = new filter();
        $product = Product::with('brand', 'images')->where('category', $category)->paginate(20);
        $product[0]->images = json_decode($product[0]->images);

        $filter = $objProperties->filter($category);


        return array("product" => $product, "filter" => $filter);

    }

    function discountProds()
    {

       return Product::whereHas('discounts', function ($query) {
           $today = date('Y-m-d');
           $query->where('dateStart', '<=', $today)->where('dateFinish', '>=', $today);
        })->get();

    }



    function search($request)
    {

        $query = $request->searchQuery;
        $product = Product::with('brand', 'images', 'discounts')->where('name', 'LIKE', '%' . $query . '%')->get();
        return $product;

    }


    function byId($id)
    {

        $product = $this->with('brand', 'images','properties')->where('id', $id)->get();

        return $product;
    }


    function cartProduct($request)
    {

        if (session()->has('product')) {

            $productArr = session("product");

            foreach ($productArr as $array) {
                $id = $array['id'];
                $product[] = $this->byId($id);

            }

            foreach ($product as $prod) {

                foreach ($request->session()->get('product') as $sessionProd) {

                    if ($prod[0]->id == $sessionProd['id']) {
                        $prod[0]->quantity = $sessionProd['quantity'];
                    }

                }
            }

            return $product;

        }
    }

    function sort($sortType, $category)
    {

        $products = null;
        if ($sortType == "priceDesc") {
            $products = DB::table('product')->where('category', $category)->orderBy('price', 'desc')->get();
            $products = Product::with('brand', 'images')->where('category', $category)->orderBy('price', 'desc')->get();

        }

        if ($sortType == "priceAsc") {
            $products = Product::with('brand', 'images')->where('category', $category)->orderBy('price', 'asc')->get();

        }

        if ($sortType == "alphabetic") {
            $products = Product::with('brand', 'images')->where('category', $category)->orderBy('name', 'asc')->get();


        }


        $json = json_encode($products);
        return $json;

    }

    function add($request){
        $product = new product();
        $product->name = $request->prodName;
        $product->price = $request->prodPrice;
        $product->category = $request->prodCategory;
        $product->brand = $request->prodBrand;
        $product->description = $request->descriptionProd;
        $product->save();
        return DB::getPdo()->lastInsertId();


    }


}
