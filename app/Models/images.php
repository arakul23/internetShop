<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class images extends Model
{
    protected $fillable = [
        'id_product', 'url'
    ];
    public  $table = 'images';
    protected $guarded = [
        'id',
    ];

    public function images(){
        $images = DB::table('images')->select('id_product', 'url')->get();
        return $images;
    }


}
