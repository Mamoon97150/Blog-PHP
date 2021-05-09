<?php

namespace App\Model;

class Category extends Model
{

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function categoryOfPost(\App\Entity\Posts $post)
    {
        return self::where('id', $post->getCategoryId())->first();
    }

    public function allCategories()
    {
        return self::orderBy('name', 'asc')->get()->toArray();
    }

    public function postsInCategory()
    {
        return self::select('name')->withCount('posts')->get()->toArray();
    }
}