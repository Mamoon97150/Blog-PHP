<?php


namespace App\Controller;


use App\HTTPRequest;

class CommentController extends FrontController
{

    public function createComment(HTTPRequest $request)
    {
        $id = $request->name('post_id');
        $message = $request->name();

        $comment = new \Comments();
        $comment->addComment($message);
        return redirect('blog.show',['id' => $id]);
    }

    public function delete($id, $postId)
    {
        $comment = new \Comments();
        $comment->eraseComment($id);

        return redirect('blog.show', ['id' => $postId]);
    }

}