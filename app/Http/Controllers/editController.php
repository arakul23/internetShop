<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class editController extends Controller
{

    public function editProduct(Request $request)
    {
        $file = Input::file('nameImage');
        if (!empty($file)) {
            $oldPath = $file->getPathName();
            $fileName = $file->getClientOriginalName();
            $newPath = "..\public\img\\" . $fileName;
            $this->editImage($request->idProductEdit, $newPath);
        }

        DB::table('product')->where('id', '=', $request->idProductEdit)->update(['name' => $request->prodNameEdit, 'price' => $request->prodPriceEdit, 'category' => $request->prodCategoryEdit, 'brand' => $request->prodBrandEdit, 'description' => $request->descriptionProdEdit]);

        return redirect('adminProduct');


    }


    public function editImage($productId, $newPath)
    {

        DB::table('images')->where('id_product', '=', $productId)->update(['url' => $newPath]);
    }


    public function editBrand(Request $request)
    {
        $brandId = $request->idBrandEdit;
        $brandName = $request->brandNameEdit;
        DB::table('brand')->where('id', '=', $brandId)->update(['name' => $brandName]);
        return redirect()->back();
    }

    public function editCategory(Request $request)
    {
        $objCategory = new category();
        $categoryId = $request->idCategoryEdit;
        $categoryName = $request->categoryNameEdit;
        $categoryParent = $request->parentCategory;

        $objCategory->edit($categoryId, $categoryName, $categoryParent);
        return redirect()->back();
    }

}