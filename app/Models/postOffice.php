<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postOffice extends Model
{


    public $rules = [
        'name', "address", "lat", "lng", "working_time" => 'required',
    ];

    protected $fillable = [
        'name', 'address', 'lat', 'lng', 'working_time'
    ];

    protected $table = 'post_office';
}
