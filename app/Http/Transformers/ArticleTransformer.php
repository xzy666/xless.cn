<?php
/**
 * Created by PhpStorm.
 * User: xizy
 * Date: 2017/8/29
 * Time: 下午11:04
 */
namespace App\Transformers;
use App\Article;
use League\Fractal\TransformerAbstract;

/**
 * Class ArticleTransformer
 * @package App\Transformers
 */
class ArticleTransformer extends TransformerAbstract {

    /**
     * @var array
     */
    protected $availableIncludes=[
        'tags'
    ];

    /**
     * @param Article $article
     * @return array
     */
    public function transform(Article $article)
    {
        return array(
            'id'                => $article->id,
            'title'             => $article->title,
            'subtitle'          => $article->subtitle,
            'user'              => $article->user,
            'slug'              => $article->slug,
            'content'           => collect(json_decode($article->content))->get('raw'),
            'page_image'        => $article->page_image,
            'meta_description'  => $article->meta_description,
            'is_original'       => $article->is_original,
            'is_draft'          => $article->is_draft,
            'visitors'          => $article->view_count,
            'published_at'      => $article->published_at->diffForHumans(),
            'published_time'    => $article->published_at->toDateTimeString(),
        );
    }

    /**
     * @param Article $article
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTags(Article $article)
    {
        $tags=$article->tags;
        return $this->collection($tags,new TagTransformer);
    }
}