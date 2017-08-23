<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/8/23
 * Time: 下午8:56
 */
namespace App\Repositories;
trait BaseRepository{

    /**
     * 获取模型数量
     * @return mixed
     */
    public function getNums()
    {
        return $this->model->count();
    }

    /**
     * 更新一条记录
     * @param $id
     * @param $new
     * @return mixed
     */
    public function updateCol($id, $new)
    {
        $this->model=$this->getById($id);
        foreach ($new as $k=>$v){
            $this->model->{$k}=$v;
        }
        return $this->model->save();
    }

    /**
     * 删除指定模型
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * 根据id获取指定模型
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 获取表所有记录
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * 分页
     * @param int $no 每页数量
     * @param string $sort 排序方法
     * @param string $orderBy 排序根据
     * @return mixed
     */
    public function page($no = 10, $sort = 'desc', $orderBy = 'created_at')
    {
        return $this->model->orderBy($orderBy,$sort)->paginate($no);
    }

    /**
     * 增加一条新记录
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        return $this->save($this->model,$input);
    }

    /**
     * 根据id更新一条记录
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id,$input)
    {
       $this->model=$this->getById($id);
       return $this->model->save($this->model,$input);
    }

    /**
     * 保存模型的数据
     * @param $model
     * @param $input
     * @return mixed
     */
    public function save($model, $input)
    {
        $model->fill($input);
        $model->save();
        return $model;
    }
}