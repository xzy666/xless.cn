<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/8/23
 * Time: 下午11:08
 */

namespace App\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DraftScope implements Scope{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_draft','=',0);
    }
}