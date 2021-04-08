<?php


use Illuminate\Database\Capsule\Manager as Capsule;

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

    public function commentsByPost($id)
    {
        return self::with('user')->where('post_id', $id)->get()->toArray();
    }

    public function commentsCount($column, $value)
    {
        return self::where($column ,$value)->count();
    }

    public function addComment($message)
    {
        return self::create($message);
    }

    public function eraseComment($id)
    {
        return self::destroy($id);
    }

    public function countComments()
    {
        return self::count();
    }

    public function commentsByDate()
    {
        return self::groupBy(Capsule::raw('MONTH(created_at)'))
            ->select(Capsule::raw('created_at, COUNT(*) as count'))
            ->get()->toArray();

/*        return Capsule::table('comments')->groupBy('MONTH(created_at)')->select('created_at', 'COUNT(*) as count')->toArray();*/
    }
}
