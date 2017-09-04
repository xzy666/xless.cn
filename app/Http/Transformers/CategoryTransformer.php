<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/2
 * Time: 上午8:29
 */

namespace App\Transformers;


use App\Category;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer
 * @package App\Transformers
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * @param Category $category
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'=>$category->id,
            'name'=>$category->name,
            'path'=>$category->path,
            'description'=>$category->description,
            'status'=>$category->status,
            'created_at'=>$category->created_at->toDateTimeString()
        ];
    }

}