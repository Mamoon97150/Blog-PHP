<?php


namespace App\Controller;


use App\Entity\Posts;
use App\Entity\Users;
use App\HTTPRequest;
use App\Model\Comments as CommentModel;
use App\Entity\Comment;
use App\Model\Posts as PostModel;
use App\Model\Users as UserModel;

class CommentController extends FrontController
{
    /**
     * Récupère les données du commentaires depuis le formulaire,
     * hydrate l'objet Comment et l'ajoute à la base de données
     *
     * @param HTTPRequest $request
     */
    public function createComment(HTTPRequest $request)
    {
        $postId = $request->name('post_id');
        $message = $request->validator([
            'comment' => ['required']
        ]);

        $comment = (new Comment())
            ->setId($message['id'])
            ->setPostId($message['post_id'])
            ->setUserId($message['user_id'])
            ->setComment($message['comment'])
        ;
        (new CommentModel())->addComment($comment);

        return redirect('blog.show',['id' => $postId]);
    }

    /**
     * Récupère les information du commentaire et le supprime de la base de données
     *
     * @param $commentId
     * @param $postId
     * @param $userId
     */
    public function delete($commentId, $postId, $userId)
    {
        $request = new HTTPRequest();

        if ($request->session('id') == $userId || $request->session('auth') == 'admin')
        {
            (new CommentModel())->eraseComment($commentId);
        };

        return redirect('blog.show', ['id' => $postId]);
    }

    /**
     * Récupère les information du commentaire, approuve son contenu et le met a jour dans la base de données
     *
     * @param $commentId
     */
    public function approveComments($commentId)
    {
        (new CommentModel())->approval($commentId);

        return redirect('admin.pendingComments');
    }

    /**
     * Récupère la liste des commentaires du post depuis la base de donnée,
     * hydrate les objet Comment et User , les ajoute a un array stocké dans un array et l'affiche en liste
     *
     * @param $postId
     * @return array
     */
    public function showComments($postId): array
    {
        $commentsData = (new CommentModel())->commentsByPost($postId);
        $comments = [];
        foreach ($commentsData as $comment)
        {
            $dataCom['comment'] = (new Comment())
                ->setId($comment['id'])
                ->setPostId($comment['post_id'])
                ->setUserId($comment['user_id'])
                ->setComment($comment['comment'])
                ->setApproved($comment['approved'])
                ->setUpdatedAt($comment['updated_at'])
            ;

            $userData = (new UserModel())->author($dataCom['comment']);
            $user = (new Users())
                ->setId($userData['id'])
                ->setImg($userData['img'])
                ->setUsername($userData['username'])
                ->setRole($userData['role'])
            ;
            $dataCom['user'] = $user;

            $comments[] = $dataCom;
        }
        return $comments;
    }

    /**
     * Récupère la liste des commentaires depuis la base de donnée,
     * hydrate les objet Comment, User et Post , les ajoute a un array stocké dans un array et affiche l'array
     *
     * @param array $commentsData
     * @return array
     */
    public function showCommentList(array $commentsData): array
    {
        $comments = [];
        foreach ($commentsData as $data)
        {
            $dataComment['comment'] = (new Comment())
                ->setId($data['id'])
                ->setComment($data['comment'])
                ->setUserId($data['user_id'])
                ->setPostId($data['post_id'])
                ->setApproved($data['approved'])
                ->setUpdatedAt($data['updated_at'])
                ->setCreatedAt($data['created_at'])
            ;

            $userData = (new UserModel())->author($dataComment['comment']);
            $user = (new Users())
                ->setId($userData['id'])
                ->setUsername($userData['username'])
            ;
            $dataComment['user'] = $user;

            $postData = (new PostModel())->findPost($dataComment['comment']->getPostId());
            $post = (new Posts())
                ->setId($postData['id'])
                ->setTitle($postData['title'])
            ;
            $dataComment['post'] = $post;

            $comments[] = $dataComment;
        }
        return $comments;
    }

}