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
use App\discounts;
use App\brand;
use App\property_product;


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
        
        if(!empty($file)){
        $oldPath = $file->getPathName();
        $fileName = $file->getClientOriginalName();

        $newPath = "..\public\img\\".$fileName;
    }
        $product = new product();
        $image = new images();
        $product->name = $request->prodName;
        $product->price = $request->prodPrice;
        $product->category = $request->prodCategory;
        $product->brand = $request->prodBrand;
        $product->description = $request->descriptionProd;
        $product->save();

        $lastId = DB::getPdo()->lastInsertId();
        if(!empty($file)){
        $image->id_product =  $lastId;
        move_uploaded_file($oldPath, $newPath);
        $image->url = "..\public\img\\" . $fileName;
        $image->save();
    }
        $this->addPropertiesProduct($request, $lastId);
                return redirect('adminProduct');



    }


    public function addPropertiesProduct($request, $lastId){
        $propertyProduct = new property_product();
        foreach ($request->propertyName as $prop) {
        echo "id = ".$prop."<br>";
        echo $request->$prop;
        $propertyProduct->insert(['id_product' => $lastId, 'id_property' => $prop, 'value' => $request->$prop, 'type' => 'text']);

        
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

    public function addCharacteristic(Request $request){
        $properties = new properties();
        $properties->name = $request->characteristicName;
        $properties->save();

    }

    public function addBrand(Request $request){
        $brand = new brand();
        $brand->name = $request->brandName;
        $brand->save();
        return redirect()->back();
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

   public function addDiscount(Request $request){
        $discounts = new discounts();
        $discounts->id_product = $request->productId;
        $discounts->percent = $request->discountPercent;
        $discounts->dateStart = $request->dateStart;
        $discounts->dateFinish = $request->dateFinish;
        $discounts->save();
        return redirect('adminDiscounts');

    }

    

      public function deleteCategory(Request $request)

    {
        $category = category::all()->where("id", $request->productId)->first();
        $category->delete();
        return redirect('adminAdd');

    }


}
