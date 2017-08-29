<?php

namespace App\Http\Controllers\api;

use App\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ArticleController
 * @package App\Http\Controllers\api
 */
class ArticleController extends ApiController
{

    /**
     * @var ArticleRepository
     */
    protected  $article;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    function __construct(ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->article=$articleRepository;
    }

    /**
     * 返回全部文章信息
     * @return mixed
     */
    public function articles()
    {
        return $this->responseWithArray($this->article->page(),new ArticleTransformer);
    }
}
