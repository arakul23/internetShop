<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class category extends Model
{
    protected $fillable = [
        'name', 'price', 'category', 'image'
    ];
    public $table = 'category';
    protected $guarded = [
        'id',
    ];

    function allCategories()
    {
        $category = DB::table('category')->get();
        return $category;

    }

    function byId($categoryId)
    {
        $category = DB::table('category')->where('id', $categoryId)->get();
        return $category;

    }

    function edit($id, $name, $parent)
    {

        DB::table('category')->where('id', $id)->update(['name' => $name, 'parent_id' => $parent]);
        return redirect()->back();
    }

    function deleteById($id)
    {
        DB::table('category')->where('id', $id)->delete();
        return redirect()->back();

    }
}
