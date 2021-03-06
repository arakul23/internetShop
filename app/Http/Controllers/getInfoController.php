<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\discounts;
use App\Models\brand;
use App\Models\category;
use App\Models\deliveryMethod;
use App\Models\Address_deliveries;

class getInfoController extends Controller
{
    private $array = [];

    public function getCategories()
    {
        $objCategory = new category();
        $category = $objCategory->allCategories();
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

    public function payment(Request $request): void
    {
        $price = round($request->session()->get('fullPrice') / 27, 2);


        $paypalEmail = "paypaybusinessaccount@email.com";
        $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
        $itemName = "Upgrade account";
        $returnUrl = "full-url-for-page-where-user-returns-if-pays";
        $cancelUrl = "full-url-for-page-where-user-returns-if-cancels-payment";
        $notifyUrl = "full-url-where-the-ipn-returns";
        $querystring = 'cmd=_notify-validate';

        $querystring .= "?business=" . urlencode($paypalEmail) . "&";

//Добавляем сумму и валюту
        $querystring .= "currency_code=" . urlencode('USD') . "&";
        $querystring .= "lc=" . urlencode('US') . "&";

//остальные данные
        $querystring .= "bn=" . urlencode('YourBussiness_BuyNow_WPS_US') . "&";
        $querystring .= "no_note=" . urlencode('1') . "&";
        $querystring .= "cmd=" . urlencode('_xclick') . "&";

//ид пользователя – чтоб знати при ответе Paypal кто заплатил

        $querystring .= "item_name=" . urlencode($itemName) . "&";
        $querystring .= "amount=" . urlencode($price) . "&";

//мы не используем этот код – но он нужен, если отправляются какие-то данные из формы
        /* foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $querystring .= "$key=$value&";
        } */

//Добавление адресов возврата
        $querystring .= "return=" . urlencode(stripslashes($returnUrl)) . "&";
        $querystring .= "cancel_return=" . urlencode(stripslashes($cancelUrl)) . "&";
        $querystring .= "notify_url=" . urlencode($notifyUrl);
        header('Location:' . $paypalURL . $querystring);
        $request->session()->forget(["fullPrice", "fullCountProd", "product"]);
        exit();
    }

    public function getUserOrders()
    {
        $items = [];
        $ordersItems = [];
        $orders = DB::table('orders')->select('id')->where('email', Auth()->user()->email)->get();

        foreach ($orders as $key => $order) {
            $ordersItems = DB::table('orders_items')->select('item_id')->where('order_id', $orders[$key]->id)->get();

        }
        foreach ($ordersItems as $key => $item) {

            $items[] = Product::with('images')->where('id', $item->item_id)->get();
        }

        return $items;

    }

    public
    function getDiscounts()
    {

        $objDiscount = new discounts();
        $productDiscount = $objDiscount->discountProds();
        return $productDiscount;
    }

    public
    function getProduct($pagination)
    {
        $objProduct = new product();
        $product = $objProduct->allProd($pagination);
        return $product;
    }

    public
    function getProductById($request)
    {
        $objProduct = new Product();
        $id = $request->idVal;
        $product = $objProduct->byId($id);

        return $product;
    }

    public function getDiscountProducts()
    {

        $objProduct = new discounts();
        $discountProds = $objProduct->discountProds();

        foreach ($discountProds as $discountProd) {

            $discountProd['products']['discountPrice'] = $discountProd['products']['price'] - (($discountProd['products']['price'] * ($discountProds[0]->percent / 100)));
        }
        return $discountProds;
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

    public function getAddressesDelivery()
    {

        $objAddressesDelivery = new Address_deliveries();
        $objDeliveryMethods = new deliveryMethod();
        $deliveryMethods = $objDeliveryMethods->allMethods();
        $addresses = $objAddressesDelivery->allAddresses();
        return array($addresses, $deliveryMethods);
    }


    public
    function getDeliveryMethod()
    {
        $objDelivery = new deliveryMethod();
        $delivery = $objDelivery->allMethods();
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

