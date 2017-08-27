<?php

namespace App;

use App\Services\Markdowner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $dates=['dateted_at'];
    /**
     * @var array
     */
    protected $fillable=[
        'user_id','commentable_id','commentable_type','content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * @param $value
     */
    public function setContentAttributes($value)
    {
        $data=[
            'raw'=>$value,
            'html'=>(new Markdowner())->convertMarkdownToHtml()
        ];
        $this->attributes['content']=json_encode($data);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
