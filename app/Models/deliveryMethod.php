<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class deliveryMethod extends Model
{
    protected $fillable = [
        'name'
    ];
    public $table = 'delivery_method';
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;

    function allMethods()
    {
        $delivery = DB::table('delivery_method')->get();
        return $delivery;
    }

    function add($request)
    {

        $this->name = $request->nameDelivery;
        $this->save();
        return redirect()->back();

    }

}
