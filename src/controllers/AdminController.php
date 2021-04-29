<?php


namespace App\Controller;



use App\HTTPRequest;
use App\Model\Posts as PostModel;
use App\Model\Comments as CommentModel;
use App\Model\Category as CategoryModel;
use App\Model\Users as UserModel;

class AdminController extends FrontController
{
    public function index()
    {

        $post = (new PostModel())->lastPost();
        $users =(new UserModel())->countUsers();
        $commentsPending = (new CommentModel())->commentsCount('approved', '0');
        $comments = (new CommentModel())->countComments();

        $this->renderView('admin/home', compact(['post', 'users', 'commentsPending', 'comments']));
    }

    public function adminPost()
    {
        $postsData = (new PostModel())->allPosts();
        $posts = (new PostController())->showPostList($postsData);

        $this->renderView('admin/posts/posts', compact('posts'));
    }

    public function addPost()
    {
        $categories = (new CategoryModel())->allCategories();
        $this->renderView('admin/posts/addpost', compact('categories'));
    }

    public function editPost($postId)
    {
        $categories = (new CategoryModel())->allCategories();
        $post = (new PostController())->showPost($postId);

        $this->renderView('admin/posts/editpost', compact(['categories', 'post']));
    }

    public function adminComments()
    {
        $commentsData = (new CommentModel())->allComments();
        $comments = (new CommentController())->showCommentList($commentsData);

        $this->renderView('admin/comments/comments', compact('comments'));
    }

    public function pendingComments()
    {
        $commentsData = (new CommentModel())->commentsPendingApproval();
        $comments = (new CommentController())->showCommentList($commentsData);

        $this->renderView('admin/comments/pending', compact('comments'));
    }

    public function adminUsers()
    {
        $usersData = (new UserModel())->allUsers();
        $users = (new UserController())->showUserList($usersData);

        $this->renderView('admin/users/users', compact('users'));

    }

    public function manageAdmin()
    {
        $usersData = (new UserModel())->userByRole('admin');
        $users = (new UserController())->showUserList($usersData);

        $this->renderView('admin/users/adminRole', compact('users'));
    }

    public function manageUser()
    {
        $usersData = (new UserModel())->userByRole('user');
        $users = (new UserController())->showUserList($usersData);

        $this->renderView('admin/users/userRole', compact('users'));
    }

}