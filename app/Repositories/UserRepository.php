<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/6
 * Time: 上午9:49
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    protected $model;
    use BaseRepository;
    function __construct(User $user)
    {
        $this->model=$user;
    }

    public function getList()
    {
        return $this->model
                    ->orderBy('id','desc')
                    ->get();
    }

    public function getByName($name)
    {
        return $this->model
                    ->where('name','=',$name)
                    ->first();
    }
}