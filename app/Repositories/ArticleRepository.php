<?php
namespace App\Repositories;
use App\Article;
use App\Scope\DraftScope;
use App\Visitor;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository {
    use BaseRepository;
    /**
     * @var Article
     */
    protected $model;
    /**
     * @var Visitor
     */
    protected $visitor;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     * @param Visitor $visitor
     */
    function __construct(Article $article,Visitor $visitor)
    {
        $this->model=$article;
        $this->visitor=$visitor;
    }

    /**
     * 验证
     * @return $this|Article
     */
    public function checkAuthScope()
    {
        if (auth()->check()&&auth()->user()->is_admin){
            $this->model=$this->model->withoutGlobalScope(DraftScope::class);
        }
        return $this->model;
    }

    /**
     * 分页
     * @param int $no
     * @param string $sort
     * @param string $orderBy
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function page($no = 10, $sort = 'desc', $orderBy = 'created_at')
    {
        $this->model=$this->checkAuthScope();
        return $this->model->orderBy($orderBy,$sort)->paginate($no);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->model->withGlobalScope(DraftScope::class)->findOrFail($id);
    }

    /**
     * 更新
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        $this->model = $this->model->withoutGlobalScope(DraftScope::class)->findOrFail($id);

        return $this->save($this->model, $input);
    }

    /**
     * 通过别名获取文章
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function getBySlug($slug)
    {
        $this->model=$this->checkAuthScope();
        $article=$this->model->where('slug','=',$slug)->firstOrFail();
        $article->increment('view_count');
        $this->visitor->log($article->id);
        return $article;
    }

    /**
     * @param array $tags
     */
    public function syncTag(array $tags)
    {
        $this->model->tags()->sync($tags);
    }

    /**
     * @param $q
     * @return \Illuminate\Support\Collection
     */
    public function search($q)
    {
        $q=trim($q);
        return $this->model
                    ->where('title','like',"%{$q}%")
                    ->orderBy('published_at')
                    ->get();
    }

    /**
     * @param $id
     * @return bool|null
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }
}