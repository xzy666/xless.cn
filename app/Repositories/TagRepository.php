<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/4
 * Time: 下午8:49
 */

namespace App\Repositories;


use App\Tag;

class TagRepository
{
    use BaseRepository;
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Get record by the name.
     *
     * @param  string $name
     * @return collection
     */
    public function getByName($name)
    {
        return $this->model->where('tag', $name)->first();
    }
}