<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonModel extends Model
{
    protected $table ="lesson";
    protected $fillable = [
        "lesson_name",
        "lesson_detail",
        "username",
        "course_id"
    ];
}
