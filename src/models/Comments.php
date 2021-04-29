<?php


class Comments extends Model
{
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Users::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

}