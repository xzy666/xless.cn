<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $article;
    function __construct(ArticleRepository $articleRep)
    {
        $this->article=$articleRep;
    }
}
