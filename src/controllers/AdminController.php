<?php


namespace App\Controller;



use App\HTTPRequest;

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

    public function addPost()
    {
        $Category = new \Category();
        $categories = $Category->allCategories();

        $this->renderView('admin/posts/addpost', compact('categories'));
    }

    public function editPost($id)
    {
        $Category = new \Category();
        $categories = $Category->allCategories();

        $Posts = new \Posts();
        $post = $Posts->showPost($id);


        $this->renderView('admin/posts/editpost', compact(['categories', 'post']));
    }

    public function adminComments()
    {
        $comment = new \Comments();

        $comments = $comment->allComments();

        $this->renderView('admin/comments/comments', compact('comments'));
    }

    public function pendingComments()
    {
        $comment = new \Comments();

        $comments = $comment->commentsPendingApproval();

        $this->renderView('admin/comments/pending', compact('comments'));
    }

    public function adminUsers()
    {
        $user = new \Users();
        $users = $user->allUsers();

        $this->renderView('admin/users/users', compact('users'));

    }

    public function manageAdmin()
    {
        $user = new \Users();
        $users = $user->userByRole('admin');

        $this->renderView('admin/users/adminRole', compact('users'));
    }

    public function manageUser()
    {
        $user = new \Users();
        $users = $user->userByRole('user');

        $this->renderView('admin/users/userRole', compact('users'));
    }

}