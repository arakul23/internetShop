<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class images extends Model
{
    protected $fillable = [
        'product_id', 'url'
    ];
    public $table = 'images';
    protected $guarded = [
        'id',
    ];

    public function images()
    {
        $images = DB::table('images')->select('id_product', 'url')->get();
        return $images;
    }

    public function edit($productId, $newPath)
    {

        Images::updateOrCreate(
            ['product_id' => $productId],
            ['url' => $newPath]

        );

    }

    function add($objImage, $file, $idProduct)
    {
        if (!empty($file)) {

            $oldPath = $file->getPathName();
            $fileName = $file->getClientOriginalName();
            $newPath = "public\img\\" . $fileName;

            $objImage->product_id = $idProduct;
            move_uploaded_file($oldPath, $newPath);

            $objImage->url = "public\img\\" . $fileName;
            $objImage->save();
        }
    }


}
