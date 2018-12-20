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

    public function getProductFromCategory(Request $request)
    {
        $product = DB::table('product')->where("category", $request->categoryId)->get();
        $images = $this->getImages($product);
        foreach ($product as $prod) {
            foreach ($images as $image) {
                if ($prod->id === $image->id_product) {
                    $prod->image = $image->url;
                }
            }
        }
        return view('product', compact('product'));


    }


    public function getProduct()
    {
        $product = DB::table('product')->get();
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


    public function getIdArray()
    {
        $array = [session("idProduct")];
        $json = json_encode($array);
        echo $json;
    }


   /* public function getProductFull($productArr)
    {
        $product = array();
        $images = $this->getImages();
        $properties = array();
        if (empty($productArr)) {
            return false;
        } else {
            foreach ($productArr as $array) {

           $result = DB::table('product')->select("id", "name", "price", 'description')->where("id", $array['id'])->get();
                array_push($product, $result);


            }

            $char  = DB::table('product')->join('property_product', 'product.id', '=', 'id_product')->join('properties', 'properties.id', '=', 'property_product.id_property')->
           select('properties.name', 'property_product.value')->where("product.id", $array['id'])->get();

$characteristics = array('char' => json_decode($char, true));
        }
     
        foreach ($product as $prod) {

            foreach ($images as $image) {
                if ($prod[0]->id === $image->id_product) {
                    $prod[0]->image = $image->url;
                }
            }


        }




        return array($product,$characteristics);
    } */



public function getProductFull($productArr)
    {
        $product = array();
        $properties = array();

        $images = $this->getImages();
        if (empty($productArr)) {
            return false;
        } else {
            foreach ($productArr as $array) {
                $result = DB::table('product')->select("id", "name", "price", 'description')->where("id", $array['id'])->get();
                array_push($product, $result);
            }


$char  = DB::table('product')->join('property_product', 'product.id', '=', 'id_product')->join('properties', 'properties.id', '=', 'property_product.id_property')->
           select('properties.name', 'property_product.value')->where("product.id", $array['id'])->get();
           $properties = array('properties' => json_decode($char, true));

        }
        foreach ($product as $prod) {
            foreach ($images as $image) {
                if ($prod[0]->id === $image->id_product) {
                    $prod[0]->image = $image->url;
                }
            }
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

           if ($prod[0]->id == $sessionProd['id']) {
               $prod[0]->quantity = $sessionProd['quantity'];
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







}
