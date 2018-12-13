<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $fillable = [
        'id_product', 'url'
    ];
    public  $table = 'images';
    protected $guarded = [
        'id',
    ];
}
