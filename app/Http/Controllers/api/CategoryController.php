<?php

namespace App\Http\Controllers\api;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends ApiController
{
    protected $category;
    function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->category=$category;
    }
}
