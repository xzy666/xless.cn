<?php
namespace  App;

use App\Repositories\BaseRepository;

/**
 * Class CommentRepository
 * @package App
 */
class CommentRepository{
    use BaseRepository;
    /**
     * @var Comment
     */
    protected  $model;

    /**
     * CommentRepository constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model=$comment;
    }

    /**
     * @param $commentableId
     * @param $commentableType
     * @return \Illuminate\Support\Collection
     */
    public function getByCommentable($commentableId, $commentableType)
    {
        return $this->model->where('commentable_id',$commentableId)
                    ->where('commentable_type',$commentableType)
                    ->get();
    }

    //Vote 相关的之后在写
}