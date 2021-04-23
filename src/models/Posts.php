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

    public function comments()
    {
        return $this->hasMany(Comments::class);
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

    public function updatePost($id, $data)
    {
        return self::where('id', $id)->update($data);
    }

    public function erasePost($id)
    {
        return self::destroy($id);
    }
}