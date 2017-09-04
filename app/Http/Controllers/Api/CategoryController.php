<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class CategoryController
 * @package App\Http\Controllers\api
 */
class CategoryController extends ApiController
{
    /**
     * @var CategoryRepository
     */
    protected $category;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $category
     */
    function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category=$category;
    }

    /**
     * 获取分类分页信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->responseWithPaginator($this->category->page(),new CategoryTransformer());
    }

    /**
     * 获取所有分类
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        return $this->responseWithCollection($this->category->all(),new CategoryTransformer());
    }

    /**
     * 存储新的分类Request
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->category->store($request->all());
        return $this->noContent();
    }

    /**
     * 修改某些行
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id, Request $request)
    {
        $this->category->updateCol($id,$request->all());
        
        return $this->noContent();
    }

    /**
     * 编辑
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
       return $this->responseWithItem($this->category->getById($id),new CategoryTransformer());
    }

    /**
     * 更新
     * @param $id
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, CategoryRequest $request)
    {
        $this->category->update($id,$request->all());
        return $this->noContent();
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->category->destroy($id);

        return $this->noContent();
    }
}
