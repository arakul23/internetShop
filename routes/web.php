<?php

use App\Http\Controllers\getInfoController;
use Illuminate\Http\Request;

Route::get('/', function () {
    $prod = new getInfoController();
    $prodArr = $prod->getLastProduct();
    return view('welcome', compact('prodArr'));
})->name('mainPage');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/cart', function () {
    return view('cart');
});


Route::get('/data', function () {
    return view('admin/pages/tables/data');
});


Route::get('/add', function () {
    return view('admin/pages/forms/general');
});

Route::get('/ChartJS', function () {
    return view('admin/pages/charts/chartjs');
});

Route::get('/index2', function () {
    return view('admin/index2');
});

Route::get('/auth', function () {
    return view('auth/login');
});

Route::post('/filter', 'getInfoController@filter');


Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('mainPage');


});


Route::get('/checkout', function () {
    return view('checkout');
})->middleware('auth');

Route::get('/category', function () {

    $category = DB::table('category')->get();
    return view('category', compact('category'));
});

Route::get('/admin', function () {

    return view('admin/index');

})->name("admin");

Route::get('/discounts', function () {
    $objProducts = new getInfoController();
    $discountProds = $objProducts->getDiscountProducts();
    return view('discounts', compact('discountProds'));


});



Route::get('/adminDiscounts', function () {
    $obj = new getInfoController();
    $product = $obj->getProduct(false);
    $discounts = $obj->getDiscounts();
    $category = $obj->getCategory();
    foreach ($discounts as $disc) {
        foreach ($category as $cat) {
            if ($disc->category === $cat->id) {
                $disc->categoryName = $cat->name;
            }
        }
    }
    return view('admin/pages/tables/discounts', compact('discounts', 'product'));
});


Route::get('/adminDeliveryAddress', function (){
    $obj = new getInfoController();
    $arr = $obj->getAddressesDelivery();
    $addresses = $arr[0];
    $deliveryMethods  = $arr[1];
    return view('admin/pages/tables/address_delivery', compact('addresses', 'deliveryMethods'));

});

Route::get('/adminProduct', function () {
    $obj = new getInfoController();
    $product = $obj->getProduct(true);
    $category = $obj->getCategories();
    $properties = $obj->getProperties();
    $brand = $obj->getBrand();
    return view('admin/pages/tables/product', compact('product', 'category', 'properties', 'brand'));
});


Route::get('/adminProperties', function () {
    $obj = new getInfoController();
    $category = $obj->getCategory();
    $properties = $obj->getProperties();
    return view('admin/pages/tables/properties', compact('properties', 'category'));
});


Route::get('/adminCategory', function () {
    $obj = new getInfoController();
    $category = $obj->getCategories();
    return view('admin/pages/tables/category', compact('category'));
});

Route::get('/adminBrand', function () {
    $obj = new getInfoController();

    $brand = $obj->getBrand();
    return view('admin/pages/tables/brand', compact('brand'));
});

Route::get('/adminDelivery', function () {
    $obj = new getInfoController();

    $delivery = $obj->getDeliveryMethod();
    return view('admin/pages/tables/delivery', compact('delivery'));
});


Route::get('/sortProducts', "getInfoController@sortProducts");

Route::post('/addCat', "addOperationController@addCategory");
Route::post('/addProd', "addOperationController@addProduct");
Route::post('/addBrand', "addOperationController@addBrand");
Route::get('/selectProduct', "getInfoController@getCategoryProduct");
Route::post('/deleteProd', "deleteOperationController@deleteProduct");
Route::post('/deleteBrand', "deleteOperationController@deleteBrand");
Route::post('/deleteCategory', "deleteOperationController@deleteCategory");

Route::post('/addToCart', "AjaxController@addProduct");
Route::post('/getIdArray', "getInfoController@getIdArray");
Route::post('/deleteFromCart', "AjaxController@deleteFromCart");
Route::post('/getProductInfo', "AjaxController@getProductForEdit");
Route::post('/getBrandInfo', "AjaxController@getBrandForEdit");
Route::post('/getCategories', "AjaxController@getCategoryForEdit");

Route::post('/addPostOffice', "addOperationController@addPostOffice");
Route::post('/addCharacteristic', "addOperationController@addCharacteristic");
Route::post('/addOrder', "addOperationController@addOrder");
Route::post('/addDiscount', "addOperationController@addDiscount");
Route::post('/addCategory', "addOperationController@addCategory");
Route::post('/addDeliveryMethod', "addOperationController@addDelivery");
Route::post('/addDeliveryAddress', "addOperationController@addDeliveryAddress");

Route::post('/editProd', "editController@editProduct");
Route::post('/editBrand', "editController@editBrand");
Route::post('/editCategory', "editController@editCategory");
Route::get('/cartProduct', 'getInfoController@getCartProduct');

Route::get('/singleProduct', function (Request $request){
    $obj = new getInfoController();
    $product = $obj->getProductById($request);
    return view('single-product', compact('product'));
});
Route::post('/ordering', 'getInfoController@getFullOrderInfo');

Route::post('/postOfficeMap', "getInfoController@getPostOffice");
Route::post('/postOfficeForMap', "getInfoController@getPostOfficeForMap");
Route::post('/adminDelivery', "getInfoController@getDeliveryMethods");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/searchProduct', 'getInfoController@searchProduct');
Route::get('/clearCart', 'bdController@clearCart');
Route::get('/test', 'getInfoController@test');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
