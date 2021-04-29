<?php


class Comments extends Model
{
    public function user()
    {
        return $this->belongsTo(Users::class);
    }

}