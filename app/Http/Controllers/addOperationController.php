<?php

namespace App\Http\Controllers;

use App\Models\Address_deliveries;
use App\Models\deliveryMethod;
use App\postOffice;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\properties;
use App\Models\orders;
use App\Models\ordersItems;
use App\Models\discounts;
use App\Models\brand;
use App\Models\property_product;


class addOperationController extends Controller
{
    public function addCategory(Request $request)
    {


        $category = new category();
        $category->name = $request->categoryName;
        if ($request->parentCategoryName === 'no')
            $category->parent_id = 0;
        else
            $category->parent_id = $request->parentCategoryName;
        $category->save();
        return redirect('adminCategory');
    }

    public function addProduct(Request $request)
    {
        $product = new product();
        $lastId = $product->add($request); // Method return last insert id for image table
        $file = Input::file('nameImage');
        $images = new images();
        $images->add($images, $file, $lastId);
        $this->addPropertiesProduct($request, $lastId);
        return redirect('adminProduct');


    }


    public function addPropertiesProduct($request, $lastId)
    {
        $propertyProduct = new property_product();
        if (isset($request->propertyName)) {
            foreach ($request->propertyName as $prop) {
                $propertyProduct->insert(['id_product' => $lastId, 'id_property' => $prop, 'property_value' => $request->$prop]);

            }
        }
    }


    public function addPostOffice(Request $request)
    {

        $postOffice = new postOffice();
        $postOffice->name = $request->postOfficeName;
        $postOffice->address = $request->postOfficeAddress;
        $postOffice->lat = $request->postOfficeLat;
        $postOffice->lng = $request->postOfficeLng;
        $postOffice->working_time = $request->postOfficeTimeWorking;
        $postOffice->save();
        return redirect('add');

    }

    public function addCharacteristic(Request $request)
    {
        $properties = new properties();
        $properties->name = $request->characteristicName;
        $properties->save();
        return redirect('adminProperties');
    }


    public function addBrand(Request $request)
    {
        $brand = new brand();
        $brand->name = $request->brandName;
        $brand->save();
        return redirect()->back();
    }

    public function addOrder(Request $request)
    {
        $orders = new orders();
        $itemsOrders = new ordersItems();
        $session = $request->session();

        $cartProd = $session->get('product');
        $fullPrice = $session->get('fullPrice');
        $name = $request->userName;
        $phoneNumber = $request->userPhoneNumber;
        $delivery = $request->delivery;
        $address = $request->addressOrder;

        $orders->name = $name;
        $orders->phoneNumber = $phoneNumber;
        $orders->fullPrice = $fullPrice;
        $orders->delivery = $delivery;
        $orders->address = $address;
        $orders->save();
        $orderId = DB::getPdo()->lastInsertId();
        foreach ($cartProd as $cp) {
            $itemsOrders->insert(['order_id' => $orderId, 'item_id' => $cp['id'], 'quantity' => $cp['quantity']]);

        }

        $request->session()->forget(["fullPrice", "fullCountProd", "product"]);
        return redirect('cartProduct');





    }

    public function addDiscount(Request $request)
    {
        $discounts = new discounts();
        $discounts->product_id = $request->productId;
        $discounts->percent = $request->discountPercent;
        $discounts->dateStart = $request->dateStart;
        $discounts->dateFinish = $request->dateFinish;
        $discounts->save();
        return redirect('adminDiscounts');

    }

    public function addDelivery(Request $request)
    {
        $objDelivery = new deliveryMethod();
        $objDelivery->add($request);
    }

    public function addDeliveryAddress(Request $request)
    {
        $objDelivery = new Address_deliveries();
        $objDelivery->add($request);
    }


    public function deleteCategory(Request $request)

    {
        $category = category::all()->where("id", $request->productId)->first();
        $category->delete();
        return redirect('adminAdd');

    }


}
