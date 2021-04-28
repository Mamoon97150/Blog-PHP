<?php


namespace App\Controller;


use App\HTTPRequest;
use App\Model\Posts as PostModel;
use App\Entity\Posts;

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
        $post = (new Posts())
            ->setHook($data['hook'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setCategoryId($data['category_id'])
            ->setImg($data['img'])
            ->setUserId($data['user_id'])
        ;


        (new PostModel())->createPost($post);

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

        if ($img !== null)
        {
            $values = $request->except('img', $values);
            $data = array_merge_recursive($values, ['img' => '/public/'.$img]);

            (new PostModel())->updatePost($id, $data);

            return redirect('admin.adminPost');
        }

        (new PostModel())->updatePost($id, $values);

        return redirect('admin.adminPost');
    }



    public function deletePost($id)
    {
        (new PostModel())->erasePost($id);

        return redirect('admin.adminPost');
    }
}