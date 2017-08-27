<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

/**
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    protected $article;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRep
     */
    function __construct(ArticleRepository $articleRep)
    {
        $this->article=$articleRep;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles=$this->article
                      ->page(config('blog.article.no'),
                          config('blog.article.sort'),
                          config('blog.article.sortCol'));
        return view('article.index',compact('articles'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article= $this->article->getBySlug($slug);

        return view('article.show',compact('article'));
    }
}
