<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class filter extends Model
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

        return DB::table('filter')->where('category', $category)->get();
    }
}
