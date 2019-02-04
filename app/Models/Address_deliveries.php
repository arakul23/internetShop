<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address_deliveries extends Model
{

    protected $primaryKey = 'id';


    function deliveryMethod()
    {
        return $this->hasOne('App\Models\deliveryMethod', 'delivery_id', 'id');

    }

    function allAddresses()
    {
        return DB::table('address_deliveries')->get();


    }

    function add($request){
        $this->delivery_id = $request->deliveryId;
        $this->address = $request->address;
        $this->save();
        return redirect()->back();
    }

}
