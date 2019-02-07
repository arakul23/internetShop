<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address_deliveries extends Model
{

    public function rules()
    {
        return [
            'delivery_id' => 'required',
            'address' => 'required|min:5',
        ];
    }


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
        $this->latitude = $request->latitude;
        $this->longitude = $request->longitude;
        $this->save();
        return redirect()->back();
    }

}
