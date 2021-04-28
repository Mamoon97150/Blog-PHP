<?php


namespace App\Controller;


use App\Entity\Posts;
use App\Model\Posts as PostModel;
use App\Model\Comments as CommentModel;
use App\Model\Category as CategoryModel;
use App\Model\Users as UserModel;

class BlogController extends FrontController
{
    public function index()
    {
        $posts = (new PostModel())->allPosts();
        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexUser($id)
    {
        $posts = (new PostModel())->postsBy('user_id', $id);
        $this->renderView('blog/blog', compact('posts'));
    }

    public function indexCategory($id)
    {
        $posts = (new PostModel())->postsBy('category_id', $id);
        $this->renderView('blog/blog', compact('posts'));
    }

    public function show($id)
    {
        $data = (new PostModel())->showPost($id);
        $post = (new Posts())
            ->setId($data['id'])
            ->setHook($data['hook'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setCategoryId($data['category_id'])
            ->setUserId($data['user_id'])
            ->setImg($data['img'])
        ;
        $posts = ( new PostModel())->recentPosts();

        $comments = (new CommentModel())->commentsByPost($id);
        $count = (new CommentModel())->commentsCount('post_id', $id);

        $category = (new CategoryModel())->categoryOfPost($post);
        $categories = (new CategoryModel())->allCategories();

        $user = (new UserModel())->author($post);

        $this->renderView('blog/post/post', compact(['posts', 'post', 'categories', 'category', 'user', 'comments', 'count']));
    }
}