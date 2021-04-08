<?php


namespace App\Controller;


use App\HTTPRequest;

class BlogController extends FrontController
{
    public function index()
    {

       $posts = new \Posts();
       $posts = $posts->allPosts();

        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexUser($id)
    {
        $posts = new \Posts();
        $posts = $posts->postsBy('user_id', $id);

        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexCategory($id)
    {
        $posts = new \Posts();
        $posts = $posts->postsBy('category_id', $id);

        $this->renderView('blog/blog', compact('posts'));
    }

    public function show($id)
    {

        $Post = new \Posts();
        $post = $Post->showPost($id);
        $posts = $Post->recentPosts(5);

        $Comments = new \Comments();
        $comments = $Comments->commentsByPost($id);
        $count = $Comments->commentsCount('post_id', $id);

        $Category = new \Category();
        $category = $Category->categoryOfPost($post);
        $categories = $Category->allCategories();

        $test = $Category->postsInCategory();
        var_dump($test);

        $Users = new \Users();
        $user = $Users->author($post);

        $this->renderView('blog/post/post', compact(['posts', 'post', 'categories', 'category', 'user', 'comments', 'count']));
    }

    public function create(HTTPRequest $request)
    {

    }

}