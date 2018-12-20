<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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



}
