<?php

namespace App\Model;


class Posts extends Model
{
    protected $guarded = [];

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

    public function findPost($postId)
    {
        return self::find($postId)->toArray();
    }

    public function postsBy($column, $value)
    {
        return self::with(['category','user'])->where($column, $value)->orderBy('created_at', 'desc')->get()->toArray();
    }

    public function recentPosts()
    {
        return self::orderBy('created_at', 'desc')->limit(5)->get()->toArray();
    }

    public function countPosts()
    {
        return self::count();
    }

    public function lastPost()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

    public function createPost(\App\Entity\Posts $data)
    {
        return self::create([
            'user_id' => $data->getUserId(),
            'title' => $data->getTitle(),
            'hook' => $data->getHook(),
            'content' => $data->getContent(),
            'img' => $data->getImg(),
            'category_id' => $data->getCategoryId(),
        ]);
    }

    public function updatePost($postId, $data)
    {
        return self::where('id', $postId)->update($data);
    }

    public function erasePost($postId)
    {
        return self::destroy($postId);
    }
}