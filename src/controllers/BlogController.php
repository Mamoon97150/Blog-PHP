<?php


namespace App\Controller;


use App\HTTPRequest;

class BlogController extends FrontController
{
    public function index()
    {

        $posts = \Posts::with(['category','user'])->orderBy('dateAdded', 'desc')->get()->toArray();
        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexUser($id)
    {
        $posts = \Posts::with(['category','user'])->where('user_id', $id)->orderBy('dateAdded', 'desc')->get()->toArray();

        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexCategory($id)
    {
        $posts = \Posts::with(['category','user'])->where('category_id', $id)->orderBy('dateAdded', 'desc')->get()->toArray();

        $this->renderView('blog/blog', compact('posts'));
    }

    public function show($id)
    {
        $posts = \Posts::orderBy('dateAdded', 'desc')->limit(5)->get()->toArray();
        $post = \Posts::find($id)->toArray();

        $comments = \Comments::with('user')->where('post_id', $id)->get()->toArray();
        $count = \Comments::where('post_id',$id)->count();

        $categories = \Category::orderBy('name', 'asc')->get()->toArray();
        $category = \Category::where('id', $post['category_id'])->first();

        $user = \Users::where('id', $post['user_id'])->first();

        $this->renderView('blog/post/post', compact(['posts', 'post', 'categories', 'category', 'user', 'comments', 'count']));
    }

    public function create(HTTPRequest $request)
    {

    }
}