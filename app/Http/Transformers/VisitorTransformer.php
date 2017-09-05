<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/5
 * Time: 下午5:14
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class VisitorTransformer extends TransformerAbstract
{
    public function transform(Visitor $visitor)
    {
        return [
            'id'            => $visitor->id,
            'article'       => [ 'title' => isset($visitor->article) ? $visitor->article->title : 'null' ],
            'ip'            => $visitor->ip,
            'country'       => $visitor->country,
            'clicks'        => $visitor->clicks,
            'created_at'    => $visitor->created_at->toDateTimeString(),
        ];
    }

}