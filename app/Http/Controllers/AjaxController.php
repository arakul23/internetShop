<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Foundation\Testing\Constraints\PageConstraint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\getInfoController;
use Illuminate\Support\Facades\DB;

class AjaxController extends getInfoController
{



   public function addProduct(Request $post)
    {
        $quantity = 1;
        $price = $post->input("price");

        $id = $post->input("idProd");
        $fullPrice = $quantity * $price;
        $prodArr = array('id' => $id, 'quantity' => $quantity, 'price' => $price);
        $post->session()->put('fullPrice', round(doubleval($post->session()->get('fullPrice'))) + round(doubleval($fullPrice), 2));
        $post->session()->put('fullCountProd', $post->session()->get('fullCountProd') + $quantity);
        if ($post->session()->has('product')) {
            $count = count($post->session()->get('product'));
            for ($i = 0; $i < $count; $i++) {
                if ($post->session()->get('product')[$i]['id'] === $id) {
                    $post->session()->put("product.$i.quantity", $post->session()->get('product')[$i]['quantity'] + $prodArr['quantity']);
                    break;
                } elseif ($i + 1 == $count) {
                    $post->session()->push('product', $prodArr);
                }


            }
        } else {
            $post->session()->put('product', array());
            $post->session()->push('product', $prodArr);

        }


        $arrResult = array($post->session()->get('fullPrice'), $post->session()->get('fullCountProd'), $post->session()->get('product'));
        $json = json_encode($arrResult);
        echo $json;


        // $json = json_encode($result);
        //echo $json;
    }

  public  function deleteFromCart(Request $post)
    {
        echo count($post->session()->get('product'));
        $session = $post->session();
        for ($i = 0; $i < count($post->session()->get('product')); $i++) {

            if ($post->session()->get('product')[$i]['id'] === $_POST['id']) {
                $post->session()->put("product.$i.quantity", $post->session()->get('product')[$i]['quantity'] - 1);
                $post->session()->put('fullPrice', $post->session()->get('fullPrice') - $post->session()->get('product')[$i]['price']);
            }
            if ($post->session()->get('product')[$i]['quantity'] <= 0) {
                $post->session()->forget("product.$i");

            }
        }
        $session->put('fullCountProd', $session->get('fullCountProd') - 1);
        if ($session->get('product') > 0)
            $session->put('product', array_values($session->get('product')));

        $prodArr = array('fullCountProd' => $session->get('fullCountProd'), 'fullPrice' => $session->get('fullPrice'));
        $session->get('product', null);
        $json = json_encode($prodArr);
        echo $json;
    }

  public  function getProductForEdit(Request $request){
        $obj = new getInfoController();
        $product = DB::table('product')->where("id", $request->idProduct)->get();
        $product = $obj->mergeImage($product);
        $product = $obj->mergeBrand($product);
        $json = json_encode($product);
        echo $json;

    }

public function getBrandForEdit(Request $request){
        $brand = DB::table('brand')->where("id", $request->idBrand)->get();
        $json = json_encode($brand);
        echo $json;
}


}


