<?php

namespace App\Model;

use App\Entity\Comment;
use App\Entity\Posts;

class Users extends Model
{
    protected $guarded = [];
/*    protected $fillable = ['name', 'email', 'password'];*/

   public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function author(Posts|Comment $data)
    {
        return self::where('id', $data->getUserId())->first();
    }

    public function allUsers()
    {
        return self::orderBy('username')->get()->toArray();
    }

    public function findUser($column, $value, $column2, $value2)
    {
        return self::where($column, $value)->orWhere($column2, $value2)->first();
    }

    public function userByRole($role)
    {
        return self::where('role',$role)->get()->toArray();
    }

    public function addUser(\App\Entity\Users $user)
    {
        // Hashing password
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        // creating new user in db with hashed password
        return self::create([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $password,
            'img' => $user->getImg()
        ]);

    }

    public function changePassword(\App\Entity\Users $users)
    {
       //TODO : create password change query
    }

    public function userExists($column, $value)
    {
        $users = self::orderBy('username')->get()->toArray();
        $collection = collect($users);

        return $collection->contains($column, $value);
    }

    public function countUsers()
    {
        return self::count();
    }

    public function eraseUser($userId)
    {
        return self::destroy($userId);
    }

    public function changeRole($userId, $status)
    {
        $user = self::find($userId);
        $user->role = $status;
        $user->save();
    }
}