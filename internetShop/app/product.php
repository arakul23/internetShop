<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    public  $rules = [
        'prodName' => 'required',
    ];

    protected $fillable = [
        'name', 'price', 'category',
    ];

    public $table = 'product';
    protected $guarded = [
        'id',
    ];



}
