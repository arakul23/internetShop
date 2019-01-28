<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class category extends Model
{
    protected $fillable = [
        'name', 'price', 'category', 'image'
    ];
    public  $table = 'category';
    protected $guarded = [
        'id',
    ];

    function allCategories(){
       $category = DB::table('category')->get();
       return $category;

    }
}
