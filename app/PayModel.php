<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayModel extends Model
{
    protected $table ="pay";
    protected $fillable = [
        "pay_price",
        "pay_pic",
        "pay_datetime",
        "pay_bank",
        "course_id",
        "username",
        "pay_status"
    ];
}
