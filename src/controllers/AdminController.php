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
    /**
     * Affiche la page d'acceuil du dashboard admin
     */
    public function index()
    {

        $post = (new PostModel())->lastPost();
        $users =(new UserModel())->countUsers();
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/home', compact(['post', 'users', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des posts du dashboard admin
     */
    public function adminPost()
    {
        $postsData = (new PostModel())->allPosts();
        $posts = (new PostController())->showPostList($postsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/posts', compact(['posts', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page d'ajout de post du dashboard admin
     */
    public function addPost()
    {
        $categories = (new CategoryModel())->allCategories();
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/addpost', compact(['categories', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page d'edition de post du dashboard admin
     *
     * @param $postId
     */
    public function editPost($postId)
    {
        $categories = (new CategoryModel())->allCategories();
        $post = (new PostController())->showPost($postId);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/posts/editpost', compact(['post', 'categories', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des commentaire du dashboard admin
     */
    public function adminComments()
    {
        $commentsData = (new CommentModel())->allComments();
        $comments = (new CommentController())->showCommentList($commentsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/comments/comments', compact(['comments', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page d'approbation des commentaires du dashboard admin
     */
    public function pendingComments()
    {
        $commentsData = (new CommentModel())->commentsPendingApproval();
        $comments = (new CommentController())->showCommentList($commentsData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/comments/pending', compact(['comments', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des utilisateurs du dashboard admin
     */
    public function adminUsers()
    {
        $usersData = (new UserModel())->allUsers();
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/users', compact(['users', 'pendingCount', 'unansweredCount']));

    }

    /**
     * Affiche la page de gestion des droits des administrateurs du dashboard admin
     */
    public function manageAdmin()
    {
        $usersData = (new UserModel())->userByRole('admin');
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/adminRole', compact(['users', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des droits des utilisateurs du dashboard admin
     */
    public function manageUser()
    {
        $usersData = (new UserModel())->userByRole('user');
        $users = (new UserController())->showUserList($usersData);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/users/userRole', compact(['users', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des messages du dashboard admin
     */
    public function adminMessages()
    {
        $data = (new MessageModel())->allMessages();
        $messages = (new MessageController())->showMessageList($data);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/messages', compact(['messages', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de gestion des messages non repondu du dashboard admin
     */
    public function messagesUnanswered()
    {
        $data = (new MessageModel())->messageAnswered();
        $messages = (new MessageController())->showMessageList($data);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/notAnswered', compact(['messages', 'pendingCount', 'unansweredCount']));
    }

    /**
     * Affiche la page de réponse au message du dashboard admin
     *
     * @param $messageId
     */
    public function showMessage($messageId)
    {
        $message = (new MessageController())->showMessage($messageId);
        $pendingCount = (new CommentModel())->commentsCount('approved', '0');
        $unansweredCount = (new MessageModel())->messagesCount('answered', '0');

        $this->renderView('admin/messages/showMessage', compact(['message', 'pendingCount', 'unansweredCount']));
    }
}
