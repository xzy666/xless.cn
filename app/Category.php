<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'name','description','path','parent_id','image_url'
    ];
    protected $dates=[
        'created_at','updated_at'
    ];
}
