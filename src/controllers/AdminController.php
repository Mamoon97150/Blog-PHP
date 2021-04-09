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

    public function createPost(HTTPRequest $request)
    {
        $img = $request->loadFiles('image', 'img/loaders/', ['.jpg', '.JPG', '.png', '.PNG', '.jpeg', '.JPEG']);
        $values = $request->validator([
            'title' => ['required'],
            'hook' => ['required'],
            'content' => ['required'],
            'category' => ['required']
        ]);
        $data = array_merge_recursive($values, ['img' => 'public/'.$img]);

        var_dump($data);

        $Post = new \Posts();
        $post = $Post->createPost($data);



        return redirect('admin.adminPost');
    }

    public function deletePost($id)
    {
        $Post = new \Posts();
        $post = $Post->erasePost($id);

        return redirect('admin.adminPost');
    }


}