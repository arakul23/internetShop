<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class getInfoController extends Controller
{
    private $array = [];

    public function getCategory()
    {

        $category = DB::table('category')->get();
        return $category;

    }

        public function getBrand()
    {

        $brand = DB::table('brand')->get();
        return $brand;

    }

    public function getProperties(){
        $properties = DB::table('properties')->get();
        return $properties;
    }

    public function getProductFromCategory(Request $request)
    {

        $category = $request->categoryId;
        $product = DB::table('product')->where("category", $category)->paginate(20);
        $product = $this->mergeAttributesProduct($product);
        $brand = $this->getBrand();

        return view('product', compact('product','category','brand'));

    }


    public function mergeAttributesProduct($product){
    $product = $this->mergeImage($product);
    $product = $this->mergeDiscount($product);
    $product = $this->mergeBrand($product);
    return $product;
    
  } 



    public function mergeImage($product){
    $images = $this->getImages();

    foreach ($product as $prod) {
            foreach ($images as $image) {
                if(isset($prod->id_product)){
                     if ($prod->id_product === $image->id_product) {
                    $prod->image = $image->url;
                }
                }
                elseif ($prod->id === $image->id_product) {
                    $prod->image = $image->url;
                }
            }
        }
        return $product;
}


public function mergeDiscount($product){
        $discounts = $this->getDiscounts();

        foreach ($product as $prod) {
            foreach ($discounts as $disc) {
                if($disc->id === $prod->id){
                    $prod->price = $disc->discountPrice;
                    $prod->oldPrice = $disc->price;
                    $prod->percent = $disc->percent;
                }
            }
            }
return $product;

}


public function mergeBrand($product){
        $brand = $this->getBrand();

        foreach ($product as $prod) {
            foreach ($brand as $br) {
                if($prod->brand === $br->id){
                    $prod->brand = $br->name;
                }
            }
            }
        return $product;

}





    public function getDiscounts(){
        $today = date('Y-m-d');

    
        $product =  DB::table('product')->join('discounts', 'product.id', '=', 'id_product')->
        select('product.*', 'discounts.percent', 'discounts.id','discounts.id_product')->where('discounts.dateStart', '<=', $today)->where('discounts.dateFinish', '>=', $today)->get();
      $product = $this->mergeImage($product);
     $product = $this->mergeBrand($product);

        foreach ($product as $prod) {
           $prod->discountPrice = $prod->price - (($prod->price * ($prod->percent/100)));
           
        }

    
return $product;
}



public function getProduct($pagination)
{
    if($pagination === true)
    $product = DB::table('product')->paginate(20);
else
        $product = DB::table('product')->get();

    $product = $this->mergeAttributesProduct($product);
    $category = $this->getCategory();
   
  foreach ($product as $prod) {
    foreach ($category as $cat) {
        if($cat->id === $prod->category){
            $prod->categoryName = $cat->name;
        }
    }
}

    return $product;

}


public function getLastProduct()
{
    $product = DB::table('product')->orderBy('id', 'desc')->limit(5)->get();
    $images = $this->getImages($product);
    foreach ($product as $prod) {
        foreach ($images as $image) {
            if ($prod->id === $image->id_product) {
                $prod->image = $image->url;
            }
        }
    }

    return $product;

}




public function getProductFull($productArr)
{
    $product = array();
    $properties = array();

    if (empty($productArr)) {
        return false;
    } else {
        foreach ($productArr as $array) {
            $product = DB::table('product')->select("id", "name", "price", 'description', 'brand')->where("id", $array['id'])->get();
    

        }

               $product = $this->mergeAttributesProduct($product);


        $char  = DB::table('product')->join('property_product', 'product.id', '=', 'id_product')->join('properties', 'properties.id', '=', 'property_product.id_property')->
        select('properties.name', 'property_product.value')->where("product.id", $array['id'])->get();
        $properties = array('properties' => json_decode($char, true));

    }
    return array($product,$properties);

}




public function getPostOffice()
{

    $postOffice = DB::table('post_office')->get();
    return $postOffice;

}

public function getPostOfficeForMap(Request $request)
{

    $postOffice = DB::table('post_office')->select("lat", "lng")->where("id", $request->id)->get();
    return $postOffice;

}

public function getImages()
{

    $images = DB::table('images')->select('id_product', 'url')->get();
    return $images;


}



public function getCartProduct(Request $post){
  if (empty(session("product"))) {
    $productArr = array();
    return view('cartProduct');

} else {
    $productArr = session("product");
}

$getProduct = new getInfoController();

$fullProdInfo = $getProduct->getProductFull($productArr);
$product = $fullProdInfo[0];

foreach ($product as $prod) {
 

    foreach ($post->session()->get('product') as $sessionProd) {

     if ($prod->id == $sessionProd['id']) {
         $prod->quantity = $sessionProd['quantity'];
     }
 }
 
}

return view('cartProduct', compact("product", "countOfProd"));
}


public function getFullOrderInfo(Request $request){
    $session = $request->session();
    $fullPrice = $session->get('fullPrice');
    $delivery = $this->getDeliveryMethod();
    return view("ordering", compact('cartProd', 'fullPrice', 'delivery'));

}


public function getDeliveryMethod(){
    $delivery = DB::table('delivery_method')->get();
    return $delivery;
}



public function searchProduct(Request $request)
{
    $result = DB::table('product')->where('name', 'LIKE', '%' . $request->searchQuery . '%')->get();
    $images = $this->getImages($result);
    foreach ($result as $prod) {
        foreach ($images as $image) {
            if ($prod->id === $image->id_product) {
                $prod->image = $image->url;
            }
        }
    }
    return view('searchPage', compact('result'));


}


public function filter(Request $request){



    
}






}
