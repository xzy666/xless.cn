<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ArticleRequest;
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
    public function index()
    {
        return $this->responseWithArray($this->article->page(),new ArticleTransformer);
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $data=[
            'user_id'=>\Auth::id(),
            'last_user_id'=>\Auth::id()
        ];
        $data['is_draft']    = isset($data['is_draft']);
        $data['is_original'] = isset($data['is_original']);

        $this->article->store($data);

        $this->article->syncTag(json_decode($request->get('tags')));
        return $this->noContent();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->respondWithItem($this->article->getById($id), new ArticleTransformer);
    }

    /**
     * @param ArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $request, $id)
    {
        $data = array_merge($request->all(), [
            'last_user_id' => \Auth::id()
        ]);

        $this->article->update($id, $data);

        $this->article->syncTag(json_decode($request->get('tags')));

        return $this->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->article->destroy($id);

        return $this->noContent();
    }
}
