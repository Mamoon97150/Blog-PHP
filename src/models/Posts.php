<?php


use Illuminate\Database\Capsule\Manager as Capsule;

class Posts extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function allPosts()
    {
        return self::with(['category','user'])->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function showPost($id)
    {
        return self::find($id)->toArray();
    }

    public function postsBy($column, $id)
    {
        return self::with(['category','user'])->where($column, $id)->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function recentPosts()
    {
        return self::orderBy('created_at', 'desc')->limit(5)->get()->toArray();
    }

    public function countPosts()
    {
        return self::count();
    }

    public function lastPosts()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

}