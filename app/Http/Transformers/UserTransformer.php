<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/9/6
 * Time: 上午9:50
 */

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'avatar' => $user->avatar,
            'name' => $user->name,
            'status' => $user->status,
            'email' => $user->email,
            'nickname' => $user->nickname,
            'is_admin' => $user->is_admin,
            'is_active' => $user->is_active,
            'github_name' => $user->github_name,
            'website' => $user->website,
            'signature' => $user->signature,
            'description' => $user->description,
            'activeness' => $user->activeness,
            'experience' => $user->experience,
            'created_at' => $user->created_at->toDateTimeString(),
        ];
    }
}