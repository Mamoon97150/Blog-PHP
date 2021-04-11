<?php


namespace App\Controller;


use App\HTTPRequest;

class CommentController extends FrontController
{
    public function createComment(HTTPRequest $request)
    {
        $id = $request->name('post_id');
        $message = $request->validator([
            'comment' => ['required']
        ]);

        $comment = new \Comments();
        $comment->addComment($message);
        return redirect('blog.show',['id' => $id]);
    }

    public function delete($id, $postId)
    {
        $request = new HTTPRequest();
        $comments = new \Comments();

        if ($request->session('id') == $comment['user_id'] || $request->session('auth') == 'admin')
        {
            $comment = new \Comments();
            $comment->eraseComment($id);
        };

        return redirect('blog.show', ['id' => $postId]);
    }

    public function approveComments($id)
    {
        $comments = new \Comments();
        $comments->approval($id);

        return redirect('admin.pendingComments');
    }
}