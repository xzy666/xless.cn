<?php
namespace  App;

use App\Repositories\BaseRepository;
use App\Services\Mention;
use App\Notifications\GotVote;
use App\Notifications\MentionedUser;

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
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $mention = new Mention();

        $input['content'] = $mention->parse($input['content']);

        $comment = $this->save($this->model, $input);

        foreach ($mention->users as $user) {
            $user->notify(new MentionedUser($comment));
        }

        return $comment;
    }

    /**
     * @param $model
     * @param $input
     * @return mixed
     */
    public function save($model, $input)
    {
        $model->fill($input);

        $model->save();

        return $model;
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

    //Vote

    /**
     * @param $id
     * @param bool $isUpVote
     * @return bool
     */
    public function toggleVote($id, $isUpVote = true)
    {
        $user = auth()->user();

        $comment = $this->getById($id);

        if($comment == null) {
            return false;
        }

        return $isUpVote
            ? $this->upOrDownVote($user, $comment)
            : $this->upOrDownVote($user, $comment, 'down');
    }
}