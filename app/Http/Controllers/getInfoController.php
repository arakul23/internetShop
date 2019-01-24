<?php

namespace App\Http\Controllers;

//TODO Реализовать фильтр для разных категорий товаров
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\discounts;
use App\Models\brand;
use App\Models\property_product;
use App\Models\properties;


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
        return view('product', compact('product', 'category', 'filter', 'category'));
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


    public function getCartProduct(Request $request)
    {

        $objProduct = new product();
        $product = $objProduct->cartProduct($request);

        return view('cartProduct', compact("product"));

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

    public function sortProducts(Request $request)
    {

        $sortType = $request->sortType;
        $category = $request->category;
        $objProd = new product();
        $products = $objProd->sort($sortType, $category);
        return $products;
    }

    public
    function filter(Request $request)
    {


        $productFilter = null;
        $data = DB::table('product');

        foreach ($request->table as $table) {

            if ($table == 'Производитель') {
                if ($request->brand != null)
                    foreach ($request->brand as $brandName) {
                        $brand = new brand();
                        $productFilter = $brand->productByBrandName($brandName);
                    }
            }

            if ($table == 'ОЗУ') {
                if ($request->RAM != null) {
                    foreach ($request->RAM as $RAM) {

                    }
                }
            }


        }


        return view('filterProduct', compact('productFilter'));


    }

    public
    function test()
    {
        $objProd = new product();
        $objProd->RAM();
    }
}

