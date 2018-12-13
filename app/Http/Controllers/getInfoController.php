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


    public function getProductFull($productArr)
    {
        $product = array();
        $images = $this->getImages();
        if (empty($productArr)) {
            return false;
        } else {
            foreach ($productArr as $array) {

                $result = DB::table('product')->select("id", "name", "price", 'description')->where("id", $array['id'])->get();
                array_push($product, $result);

            }
        }
        foreach ($product as $prod) {

            foreach ($images as $image) {
                if ($prod[0]->id === $image->id_product) {
                    $prod[0]->image = $image->url;
                }
            }


        }


        return $product;
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

    public function getCartProduct(Request $request){
  if (empty(session("product"))) {
        $productArr = array();
        return view('cartProduct');

    } else {
        $productArr = session("product");
    }

    $getProduct = new getInfoController();

    $fullProdInfo = $getProduct->getProductFull($productArr);

    foreach ($fullProdInfo as $prod) {
        foreach ($post->session()->get('product') as $sessionProd) {


            if ($prod[0]->id == $sessionProd['id']) {
                $prod[0]->quantity = $sessionProd['quantity'];
            }
        }
    }
    return view('cartProduct', compact("fullProdInfo", "countOfProd"));
    }


}
