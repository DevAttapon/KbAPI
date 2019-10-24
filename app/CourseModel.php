<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table ="course";
    protected $fillable = [
        'course_name',
        'course_price',
        'course_price_pro',
        'course_detail',
        'course_pic',
        'username',
        'category_id'
    ];
}
