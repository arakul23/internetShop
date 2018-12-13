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

Route::get('/auth', function () {
    return view('auth/login');
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('mainPage');


});


Route::get('/shop', function () {
    return view('cart');
});

Route::get('/singleProduct', function (Request $request) {
    $prod = new getInfoController();
    $prodArr = array(array('id' => $request->idVal));
    $product = $prod->getProductFull($prodArr);
    $char = $prod->decodeCharacteristic($product[0][0]->characteristic);
    return view('single-product', compact('product','char'));
});

Route::get('/checkout', function () {
    return view('checkout');
})->middleware('auth');

Route::get('/category', function () {

    $category = DB::table('category')->get();
    return view('category', compact('category'));
});

Route::get('/add', function () {
    $model = new getInfoController();
    $category = $model->getCategory();
    $product = $model->getProduct();
    return view('admin/addCategory', compact("category", "product"));
})->name("add");

Route::post('/addCat', "addOperationController@addCategory");
Route::post('/addProd', "addOperationController@addProduct");
Route::post('/selectProduct', "getInfoController@getProductFromCategory");
Route::post('/deleteProd', "bdController@deleteProduct");
Route::post('/deleteCategory', "addOperationController@deleteCategory");
Route::post('/addToCart', "AjaxController@addProduct");
Route::post('/getIdArray', "getInfoController@getIdArray");
Route::post('/deleteFromCart', "AjaxController@deleteFromCart");
Route::post('/addPostOffice', "addOperationController@addPostOffice");


Route::get('/cartProduct', function (Request $post) {
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

});


Route::get("/ordering", function () {

    $postOffice = new getInfoController();
    $listOffice = $postOffice->getPostOffice();
    return view("ordering", compact("listOffice"));

});

Route::post('/postOfficeMap', "getInfoController@getPostOffice");
Route::post('/postOfficeForMap', "getInfoController@getPostOfficeForMap");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/searchProduct', 'getInfoController@searchProduct');
Route::get('/clearCart', 'bdController@clearCart');
