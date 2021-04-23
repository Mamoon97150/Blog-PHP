<?php

namespace App\Model;

use App\Entity\Posts;

class Users extends Model
{
    protected $guarded = [];
/*    protected $fillable = ['name', 'email', 'password'];*/

   public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function author(Posts $post)
    {
        return self::where('id', $post->getUserId())->first();
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

    public function addUser(array $user)
    {
        // Hashing password
        $password = password_hash($user['password'], PASSWORD_DEFAULT);

        // creating new user in db with hashed password
        return self::create([
            'username' => $user['username'],
            'email' => $user['email'],
            'password' => $password,
            'img' => $user['img']
        ]);

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

    public function eraseUser($id)
    {
        return self::destroy($id);
    }

    public function changeRole($id, $status)
    {
        $user = self::find($id);
        $user->role = $status;
        $user->save();
    }
}