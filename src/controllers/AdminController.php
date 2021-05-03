<?php


namespace App\Controller;



use App\HTTPRequest;
use App\Model\Posts as PostModel;
use App\Model\Comments as CommentModel;
use App\Model\Category as CategoryModel;
use App\Model\Users as UserModel;
use App\Model\Messages as MessageModel;

class AdminController extends FrontController
{
    public function index()
    {

        $post = (new PostModel())->lastPost();
        $users =(new UserModel())->countUsers();
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/home', compact(['post', 'users', 'pendingCount', 'unansweredCount']));
    }

    public function adminPost()
    {
        $postsData = (new PostModel())->allPosts();
        $posts = (new PostController())->showPostList($postsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/posts', compact(['posts', 'pendingCount', 'unansweredCount']));
    }

    public function addPost()
    {
        $categories = (new CategoryModel())->allCategories();
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/addpost', compact(['categories', 'pendingCount', 'unansweredCount']));
    }

    public function editPost($postId)
    {
        $categories = (new CategoryModel())->allCategories();
        $post = (new PostController())->showPost($postId);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/editpost', compact(['post', 'categories', 'pendingCount', 'unansweredCount']));
    }

    public function adminComments()
    {
        $commentsData = (new CommentModel())->allComments();
        $comments = (new CommentController())->showCommentList($commentsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/comments/comments', compact(['comments', 'pendingCount', 'unansweredCount']));
    }

    public function pendingComments()
    {
        $commentsData = (new CommentModel())->commentsPendingApproval();
        $comments = (new CommentController())->showCommentList($commentsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/comments/pending', compact(['comments', 'pendingCount', 'unansweredCount']));
    }

    public function adminUsers()
    {
        $usersData = (new UserModel())->allUsers();
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/users', compact(['users', 'pendingCount', 'unansweredCount']));

    }

    public function manageAdmin()
    {
        $usersData = (new UserModel())->userByRole('admin');
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/adminRole', compact(['users', 'pendingCount', 'unansweredCount']));
    }

    public function manageUser()
    {
        $usersData = (new UserModel())->userByRole('user');
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/userRole', compact(['users', 'pendingCount', 'unansweredCount']));
    }

    public function adminMessages()
    {
        $data = (new MessageModel())->allMessages();
        $messages = (new MessageController())->showMessageList($data);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/messages', compact(['messages', 'pendingCount', 'unansweredCount']));
    }

    public function messagesUnanswered()
    {
        $data = (new MessageModel())->messageAnswered();
        $messages = (new MessageController())->showMessageList($data);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/notAnswered', compact(['messages', 'pendingCount', 'unansweredCount']));
    }

    public function showMessage($messageId)
    {
        $message = (new MessageController())->showMessage($messageId);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/showMessage', compact(['message', 'pendingCount', 'unansweredCount']));
    }
}
