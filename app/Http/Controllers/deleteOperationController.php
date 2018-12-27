<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class deleteOperationController extends Controller
{
	public function deleteBrand(Request $request){
		$idBrand = $request->idBrand;
		DB::table('brand')->where('id', '=', $idBrand)->delete();
		return redirect()->back();

	}


	public function deleteProduct(Request $request)
    {
        $product = DB::table('product')->where("id", $request->idProduct)->delete();
        return redirect()->back();
    }	
}
