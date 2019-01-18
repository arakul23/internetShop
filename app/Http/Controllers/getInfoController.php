<?php

namespace App\Http\Controllers;

//TODO Реализовать фильтр для разных категорий товаров
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\discounts;


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

    public function getProperties()
    {
        $properties = DB::table('properties')->get();
        return $properties;
    }

    public function getCategoryProduct(Request $request)
    {

        $objProduct = new product();
        $category = $request->categoryId;
        $result = $objProduct->categoryProduct($category);
        $product = $result['product'];
        $filter = $result['filter'];
        return view('product', compact('product', 'category', 'filter'));
    }


    public
    function getDiscounts()
    {

        $objDiscount = new discounts();
        $productDiscount = $objDiscount->discounts();
        return $productDiscount;
    }

    public
    function getProduct($pagination)
    {
        if ($pagination === true)
            $product = DB::table('product')->paginate(20);
        else
            $product = DB::table('product')->get();
        $product = $this->mergeAttributesProduct($product);
        $category = $this->getCategory();

        foreach ($product as $prod) {
            foreach ($category as $cat) {
                if ($cat->id === $prod->category) {
                    $prod->categoryName = $cat->name;
                }
            }
        }
        return $product;
    }

    public
    function getLastProduct()
    {
        $objProduct = new product();
        $product = $objProduct->lastProduct();
        return $product;
    }

    public
    function getProductFull(Request $request)
    {
        $objProduct = new product();
        $result = $objProduct->fullInfo($request);
        $product = $result['product'];
        $properties = $result['properties'];
        return view("single-product", compact('product', 'properties'));
    }

    public
    function getPostOffice()
    {
        $postOffice = DB::table('post_office')->get();
        return $postOffice;
    }

    public
    function getPostOfficeForMap(Request $request)
    {
        $postOffice = DB::table('post_office')->select("lat", "lng")->where("id", $request->id)->get();
        return $postOffice;
    }

    public
    function getImages()
    {
        $images = DB::table('images')->select('id_product', 'url')->get();
        return $images;
    }


    public function getCartProduct(Request $post)
    {
        if (empty(session("product"))) {
            $productArr = array();
            return view('cartProduct');

        } else {
            $productArr = session("product");
        }

        foreach ($productArr as $array) {
            $product[] = DB::table('product')->select("id", "name", "price", 'description', 'brand')->where("id", $array['id'])->get();


        }


        $product = $this->mergeAttributesProduct($product);

        foreach ($product as $prod) {


            foreach ($post->session()->get('product') as $sessionProd) {

                if ($prod[0]->id == $sessionProd['id']) {
                    $prod[0]->quantity = $sessionProd['quantity'];
                }


                return view('cartProduct', compact("product", "countOfProd"));
            }
        }
    }


    public
    function getFullOrderInfo(Request $request)
    {
        $session = $request->session();
        $fullPrice = $session->get('fullPrice');
        $delivery = $this->getDeliveryMethod();
        return view("ordering", compact('cartProd', 'fullPrice', 'delivery'));

    }


    public
    function getDeliveryMethod()
    {
        $delivery = DB::table('delivery_method')->get();
        return $delivery;
    }


    public
    function searchProduct(Request $request)
    {
        $objProduct = new product();
        $product = $objProduct->search($request);
        return view('searchPage', compact('product'));
    }


    public
    function filter(Request $request)
    {
        $productFilter = null;


        if ($request->table[0] == "Производитель") {
            $table = 'brand';
            foreach ($request->brand as $brand) {

                $productFilter[] = DB::table('product')->join('brand', 'brand.id', '=', 'product.brand')->
                select('product.*')->where("brand.name", "=", $brand)->get();

            }

            var_dump($productFilter);

        }

        return view('filterProduct', compact('productFilter'));


    }
}

