<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Visitor
 * @package App
 */
class Visitor extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable=[
        'article_id','clicks','ip','country',''
    ];

    /**
     * @var array
     */
    protected $dates=['created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
}
