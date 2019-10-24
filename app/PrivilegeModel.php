<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrivilegeModel extends Model
{
    protected $table ="privilege";
    protected $fillable = [
        "username",
        "course_id",
        "p_datetime_start",
        "p_datetime_end",
        "p_status"
    ];
}
