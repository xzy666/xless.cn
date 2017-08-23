<?php
namespace App\Repositories;
use App\Article;

class ArticleRepository {
    use BaseRepository;
    protected $model;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     */
    function __construct(Article $article)
    {
        $this->model=$article;
    }
}