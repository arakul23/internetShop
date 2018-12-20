<?php

namespace App\Http\Controllers;

use App\postOffice;
use App\product;
use Illuminate\Http\Request;
use App\category;
use App\images;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\properties;
use App\orders;
use App\ordersItems;


class addOperationController extends Controller
{
    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'categoryName' => 'required||min:5',
        ]);

        $category = new category();
        $category->name = $request->categoryName;
        if($request->parentCategory === 'Нет')
        $category->parent_id = 0;
        else
          $category->parent_id = $request->parentCategory;
        $category->save();
        return redirect('add');
    }

    public function addProduct(Request $request)
    {
        $file = Input::file('nameImage');
        $oldPath = $file->getPathName();
        $fileName = $file->getClientOriginalName();
        $newPath = "..\public\img\\".$fileName;
        $product = new product();
        $image = new images();
        $product->name = $request->prodName;
        $product->price = $request->prodPrice;
        $product->category = $request->prodCategory;
        $product->description = $request->descriptionProd;

        $product->save();
        $image->id_product = DB::getPdo()->lastInsertId();
        move_uploaded_file($oldPath, $newPath);
        $image->url = "..\public\img\\" . $fileName;
        $image->save();
                return redirect('add');



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

    public function addCharacteristic(Request $request){
        $properties = new properties();
        $properties->name = $request->characteristicName;
        $properties->save();

    }

     public function addOrder(Request $request){
        $orders = new orders();
        $itemsOrders = new ordersItems();
        $session = $request->session();

    $cartProd = $session->get('product'); 
    $fullPrice = $session->get('fullPrice');
    $name = $request->userName;
    $phoneNumber = $request->userPhoneNumber;
    $delivery = $request->delivery;

$orders->name = $name;
$orders->phoneNumber = $phoneNumber;
$orders->fullPrice = $fullPrice;
$orders->delivery = $delivery;
$orders->save();
$orderId = DB::getPdo()->lastInsertId();
foreach($cartProd as $cp){
$itemsOrders->insert(['order_id' => $orderId, 'item_id' => $cp['id'], 'quantity' => $cp['quantity']]);

}


    }

    public function addOrder(Request $request){
        $orders = new orders();
        $itemsOrders = new ordersItems();
        $session = $request->session();

    $cartProd = $session->get('product'); 
    $fullPrice = $session->get('fullPrice');
    $name = $request->userName;
    $phoneNumber = $request->userPhoneNumber;
    $delivery = $request->delivery;

$orders->name = $name;
$orders->phoneNumber = $phoneNumber;
$orders->fullPrice = $fullPrice;
$orders->delivery = $delivery;
$orders->save();

// Добавление в item_orders
$orderId = DB::getPdo()->lastInsertId();
foreach($cartProd as $cp){
$itemsOrders->insert(['order_id' => $orderId, 'item_id' => $cp['id'], 'quantity' => $cp['quantity']]);

}


    }

      public function deleteCategory(Request $request)
    {
        $category = category::all()->where("id", $request->productId)->first();
        $category->delete();
        return redirect('add');

    }


}
