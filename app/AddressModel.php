<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
    protected $table ="address";
    protected $fillable = [
        'address',
        'subdistrict',
        'district',
        'province',
        'zipcode',
        'tel',
        'username'
    ];
}
