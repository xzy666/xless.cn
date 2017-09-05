<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
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
        'created_at','updated_at'
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
