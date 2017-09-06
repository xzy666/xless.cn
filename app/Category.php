<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable=[
        'name','description','path','parent_id','image_url'
    ];
    /**
     * @var array
     */
    protected $dates=[
        'created_at','updated_at','deleted_at'
    ];

    /**
     * 文章分类
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    ////之后有视频 问答 等等
}
