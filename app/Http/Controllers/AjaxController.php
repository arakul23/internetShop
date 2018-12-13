<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Foundation\Testing\Constraints\PageConstraint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{


    public function save(Request $post)
    {
        $hello = "Привет" . $post['mname'];
        return response()->json($hello);
    }


    function addProduct(Request $post)
    {
        $quantity = 1;
        $price = $post->input("price");

        $id = $post->input("idProd");
        $fullPrice = $quantity * $price;
        $prodArr = array('id' => $id, 'quantity' => $quantity, 'price' => $price);
        $post->session()->put('fullPrice', $post->session()->get('fullPrice') + intval($fullPrice));
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

    function deleteFromCart(Request $post)
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


}


