<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class properties extends Model
{

    public  $rules = [
        'characteristicName' => 'required',
    ];

    protected $fillable = [
        'name',
    ];

    public $table = 'properties';
    protected $guarded = [
        'id',
    ];

public function filter($category){

    return DB::table('properties')->where('category', $category)->get();
}

}
