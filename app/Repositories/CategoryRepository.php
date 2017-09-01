<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/1
 * Time: 下午7:52
 */

namespace App\Repositories;


use App\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{
    /**
     * @var Category
     */
    protected $category;
    use BaseRepository;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    function __construct(Category $category)
    {
        $this->category=$category;
    }


    /**
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return $this->model->where('name','=',$name)->first();
    }
}