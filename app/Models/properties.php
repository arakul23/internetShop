<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\property_product;

class properties extends Model
{

    public $rules = [
        'characteristicName' => 'required',
    ];

    protected $fillable = [
        'name',
    ];

    public $table = 'properties';
    protected $guarded = [
        'id',
    ];

    public function product()
    {
        return $this->belongsToMany('App\Models\product',
            'property_product',
            'id_property',
            'id_product')->withPivot('property_value');
    }




    public function filter($category)
    {

        return DB::table('properties')->where('category', $category)->get();
    }

}
