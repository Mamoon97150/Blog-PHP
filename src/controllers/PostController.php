<?php


namespace App\Controller;


use App\HTTPRequest;

class PostController extends FrontController
{

    public function createPost(HTTPRequest $request)
    {
        $img = $request->loadFiles('image', 'img/loaders/', ['.jpg', '.JPG', '.png', '.PNG', '.jpeg', '.JPEG']);
        $values = $request->validator([
            'title' => ['required'],
            'hook' => ['required'],
            'content' => ['required'],
            'category' => ['required']
        ]);
        $data = array_merge_recursive($values, ['img' => '/public/'.$img]);

        $Post = new \Posts();
        $post = $Post->createPost($data);



        return redirect('admin.adminPost');
    }

    public function updatePost(HTTPRequest $request, $id)
    {
        $img = $request->loadFiles('image', 'img/loaders/', ['.jpg', '.JPG', '.png', '.PNG', '.jpeg', '.JPEG']);
        $values = $request->validator([
            'title' => ['required'],
            'hook' => ['required'],
            'content' => ['required'],
            'category' => ['required']
        ]);

        if (!is_null($img))
        {
            $values = $request->except('img', $values);
            $data = array_merge_recursive($values, ['img' => '/public/'.$img]);

            $Post = new \Posts();
            $post = $Post->updatePost($id, $data);

            return redirect('admin.adminPost');
        }
        else
        {
            $Post = new \Posts();
            $post = $Post->updatePost($id, $values);

            return redirect('admin.adminPost');
        }
    }



    public function deletePost($id)
    {
        $Post = new \Posts();
        $post = $Post->erasePost($id);

        return redirect('admin.adminPost');
    }
}