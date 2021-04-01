<?php




class Users extends Model
{
   public function posts()
    {
        return $this->hasMany(Posts::class);
    }
}