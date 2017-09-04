<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/2
 * Time: 上午8:55
 */

namespace App\Transformers;


use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes=['user'];
    public function transform(Comment $comment)
    {
        $content=json_decode($comment->content);
        return [
            ''
        ];
    }
}