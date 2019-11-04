<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeImageModel extends Model
{
    protected $table ="image_home";
    
    protected $fillable = ['title_image'];
}
