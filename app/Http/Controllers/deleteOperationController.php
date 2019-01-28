<?php

namespace App\Http\Controllers;

use App\Models\category;
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

    public function deleteCategory(Request $request){
	    $objCategory = new category();
	    $idCategory = $request->categoryId;
	    $objCategory->deleteById($idCategory);
    }
}
