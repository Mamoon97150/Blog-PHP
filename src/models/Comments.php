<?php

namespace App\Model;
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

    public function commentsByPost($id)
    {
        return self::with('user')->where('post_id', $id)->get()->toArray();
    }
    public function commentsPendingApproval()
    {
        return self::with(['posts', 'user'])->where('approved', '=', '0' )->get()->toArray();
    }

    public function findComment($id)
    {
        return self::find($id)->toArray();
    }
    public function commentsCount($column, $value)
    {
        return self::where($column ,$value)->count();
    }

    public function addComment($message)
    {
        return self::create($message);
    }

    public function eraseComment($id)
    {
        return self::destroy($id);
    }

    public function countComments()
    {
        return self::count();
    }

    public function commentsByDate()
    {
        return self::groupBy(Capsule::raw('MONTH(created_at)'))
            ->select(Capsule::raw('created_at, COUNT(*) as count'))
            ->get()->toArray();
    }

    public function approval($id)
    {
        $comment = self::find($id);

        $comment->approved = true;
        $comment->save();
    }
}
