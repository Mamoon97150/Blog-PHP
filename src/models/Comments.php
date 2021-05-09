<?php

namespace App\Model;
use App\Entity\Comment;
use Illuminate\Database\Capsule\Manager as Capsule;

class Comments extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function allComments()
    {
        return self::with(['posts','user'])->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function commentsByPost($postId)
    {
        return self::with('user')->where('post_id', $postId)->get()->toArray();
    }
    public function commentsPendingApproval()
    {
        return self::with(['posts', 'user'])->where('approved', '=', '0' )->get()->toArray();
    }

    public function addComment(Comment $data)
    {
        return self::create([
            'post_id' => $data->getPostId(),
            'user_id' => $data->getUserId(),
            'comment' => $data->getComment(),
        ]);
    }

    public function eraseComment($commentId)
    {
        return self::destroy($commentId);
    }

    public function commentsCount($column, $value)
    {
        return self::where($column ,$value)->count();
    }


    public function commentsByDate()
    {
        return self::groupBy(Capsule::raw('MONTH(created_at)'))
            ->select(Capsule::raw('created_at, COUNT(*) as count'))
            ->get()->toArray();
    }

    public function approval($commentId)
    {
        $comment = self::find($commentId);

        $comment->approved = true;
        $comment->save();
    }
}
