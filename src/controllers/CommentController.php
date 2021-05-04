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

    public function delete($commentId, $postId, $userId)
    {
        $request = new HTTPRequest();

        if ($request->session('id') == $userId || $request->session('auth') == 'admin')
        {
            (new CommentModel())->eraseComment($commentId);
        };

        return redirect('blog.show', ['id' => $postId]);
    }

    public function approveComments($commentId)
    {
        (new CommentModel())->approval($commentId);

        return redirect('admin.pendingComments');
    }

    public function showComments($postId)
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

            $user = (new UserModel())->author($dataCom['comment']);
            $dataCom['user'] = $user;
            $comments[] = $dataCom;
        }
        return $comments;
    }

    public function showCommentList(array $commentsData)
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