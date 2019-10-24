<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    protected $table ="video";
    protected $fillable = [
        "video_link",
        "video_type",
        "video_detail",
        "video_status",
        "username",
        "course_id",
        "lesson_id"
    ];
}
