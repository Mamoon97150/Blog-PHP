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

    public function show($id)
    {

        $post = \Posts::find($id)->toArray();
        $category = \Category::where('id', $post['category_id'])->first();
        $user = \Users::where('id', $post['user_id'])->first();

        $this->renderView('blog/post/post', compact(['post', 'category', 'user']));
    }

    public function create(HTTPRequest $request)
    {

    }
}