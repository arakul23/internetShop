<?php
/**
 * Created by PhpStorm.
 * User: arakul
 * Date: 26.06.2018
 * Time: 16:43
 */

namespace App\Http\Controllers;


use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bdController extends Controller
{


    public function clearCart(Request $request)
    {
      $request->session()->put('product', null);
      $request->session()->put('fullPrice', null);
      $request->session()->put('fullCountProd', null);
      return redirect()->back();
    }

}