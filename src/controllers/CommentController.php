<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Comments as CommentModel;
use App\Entity\Comment;

class CommentController extends FrontController
{
    public function createComment(HTTPRequest $request)
    {
        $id = $request->name('post_id');
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

        return redirect('blog.show',['id' => $id]);
    }

    public function delete($id, $postId)
    {
        $request = new HTTPRequest();

        if ($request->session('id') == $comment['user_id'] || $request->session('auth') == 'admin')
        {
            (new CommentModel())->eraseComment($id);
        };

        return redirect('blog.show', ['id' => $postId]);
    }

    public function approveComments($id)
    {
        (new CommentModel())->approval($id);

        return redirect('admin.pendingComments');
    }
}