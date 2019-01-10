<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'name', 'price', 'category', 'image'
    ];
    public  $table = 'category';
    protected $guarded = [
        'id',
    ];
}
