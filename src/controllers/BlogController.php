<?php


namespace App\Controller;


use App\Entity\Categories;
use App\Entity\Posts;
use App\Entity\Comment;
use App\Entity\Users;
use App\Model\Posts as PostModel;
use App\Model\Comments as CommentModel;
use App\Model\Category as CategoryModel;
use App\Model\Users as UserModel;

class BlogController extends FrontController
{
    /**
     * Affiche la page d'acceuil du blog an triant par post
     */
    public function index()
    {
        $postsData = (new PostModel())->allPosts();
        $posts = (new PostController())->showPostList($postsData);
        $this->renderView('blog/blog', compact('posts'));
    }

    /**
     * Affiche la page d'acceuil du blog en triant par utilisateurs
     *
     * @param $userId
     */
    public function indexUser($userId)
    {
        $postsData = (new PostModel())->postsBy('user_id', $userId);
        $posts = (new PostController())->showPostList($postsData);

        $this->renderView('blog/blog', compact('posts'));
    }

    /**
     * Affiche la page d'acceuil du dashboard admin en triant par categorie
     *
     * @param $catId
     */
    public function indexCategory($catId)
    {
        $postsData = (new PostModel())->postsBy('category_id', $catId);
        $posts = (new PostController())->showPostList($postsData);
        $this->renderView('blog/blog', compact('posts'));
    }

    /**
     * Affiche le post et ses commentaires
     *
     * @param $postId
     */
    public function show($postId)
    {
        //show the post
        $post = (new PostController())->showPost($postId);
        $posts = ( new PostController())->showRecentPost();

        //show comments and comments count
        $comments = (new CommentController())->showComments($postId);
        $count = (new CommentModel())->commentsCount('post_id', $postId);


        // category filters
        $categoryData = (new CategoryModel())->categoryOfPost($post);
        $category = (new Categories())
            ->setId($categoryData['id'])
            ->setName($categoryData['name'])
        ;

        $categoriesDatum = (new CategoryModel())->allCategories();
        $categories = [];
        foreach ($categoriesDatum as $categoriesData)
        {
            $categories[] = (new Categories())
                ->setId($categoriesData['id'])
                ->setName($categoriesData['name'])
            ;
        }

        //user filter
        $userData = (new UserModel())->author($post);
        $user = (new Users())
            ->setId($userData['id'])
            ->setUsername($userData['username'])
        ;

        $this->renderView('blog/post/post', compact(['posts', 'post', 'categories', 'category', 'user', 'comments', 'count']));
    }
}