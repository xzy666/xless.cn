<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends ApiController
{
    protected $user;
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->user=$userRepository;
    }
}
