<?php


namespace App\Controller;



class AdminController extends FrontController
{
    public function index()
    {
        $Posts = new \Posts();
        $post = $Posts->lastPosts();

        $Users = new \Users();
        $users = $Users->countUsers();

        $Comments = new \Comments();
        $commentsPending = $Comments->commentsCount('approved', '0');
        $comments = $Comments->countComments();

        $this->renderView('admin/home', compact(['post', 'users', 'commentsPending', 'comments']));
    }

    public function adminPost()
    {
        $Post = new \Posts();

        $posts = $Post->allPosts();

        $this->renderView('admin/posts/posts', compact('posts'));
    }
}