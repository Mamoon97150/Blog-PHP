<?php


class Category extends Model
{

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

}