<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankModel extends Model
{
    protected $table ="bank";
    protected $fillable = [
        'bank_name',
        'bank_owner_name',
        'bank_no',
        'bank_pic',
        'username'
    ];
}
