<?php


namespace App\Controller;


use App\Entity\Categories;
use App\Entity\Users;
use App\HTTPRequest;
use App\Model\Category as CategoryModel;
use App\Model\Posts as PostModel;
use App\Entity\Posts;
use App\Model\Users as UserModel;

class PostController extends FrontController
{
    /**
     * Récupère les données du post depuis le formulaire,
     * hydrate l'objet Posts et l'ajoute à la base de données
     *
     * @param HTTPRequest $request
     */
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

    /**
     * Récupère les information du post depuis le formulaire,
     * modifie ses données et le met a jour dans la base de données
     *
     * @param HTTPRequest $request
     * @param $postId
     */
    public function updatePost(HTTPRequest $request, $postId)
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

            (new PostModel())->updatePost($postId, $data);

            return redirect('admin.adminPost');
        }

        (new PostModel())->updatePost($postId, $values);

        return redirect('admin.adminPost');
    }


    /**
     * Récupère les information du post et le supprime de la base de données
     *
     * @param $postId
     */
    public function deletePost($postId)
    {
        (new PostModel())->erasePost($postId);

        return redirect('admin.adminPost');
    }

    /**
     * Récupère la liste des post depuis la base de donnée,
     * hydrate les objet Post, User et Category , les ajoute a un array stocké dans un array et affiche l'array
     *
     * @param array $postsData
     * @return array
     */
    public function showPostList(array $postsData): array
    {
        $posts = [];
        foreach ($postsData as $data)
        {
            $dataPost['post'] = (new Posts())
                ->setId($data['id'])
                ->setHook($data['hook'])
                ->setTitle($data['title'])
                ->setCategoryId($data['category_id'])
                ->setUserId($data['user_id'])
                ->setImg($data['img'])
                ->setUpdatedAt($data['updated_at'])
                ->setCreatedAt($data['created_at'])
            ;

            $userData = (new UserModel())->author($dataPost['post']);
            $user = (new Users())
                ->setId($userData['id'])
                ->setUsername($userData['username'])
            ;
            $dataPost['user'] = $user;

            $categoryData = (new CategoryModel())->categoryOfPost($dataPost['post']);
            $category = (new Categories())
                ->setId($categoryData['id'])
                ->setName($categoryData['name'])
            ;
            $dataPost['category'] = $category;
            $posts[] = $dataPost;
        }
        return $posts;
    }

    /**
     * Récupère un post depuis la base de donnée,
     * hydrate l'objet Posts et l'affiche
     *
     * @param $postId
     * @return Posts
     */
    public function showPost($postId): Posts
    {
        $data = (new PostModel())->findPost($postId);
        return (new Posts())
            ->setId($data['id'])
            ->setHook($data['hook'])
            ->setTitle($data['title'])
            ->setContent($data['content'])
            ->setCategoryId($data['category_id'])
            ->setUserId($data['user_id'])
            ->setImg($data['img']);
    }

    /**
     * Récupère la liste des posts récent depuis la base de donnée,
     * hydrate l'objet Posts, l'ajoute a un array stocké dans un array et affiche l'array
     *
     * @return array
     */
    public function showRecentPost(): array
    {
        $postsData = ( new PostModel())->recentPosts();
        $posts = [];
        foreach ($postsData as $data)
        {
            $posts[] = (new Posts())
                ->setId($data['id'])
                ->setTitle($data['title'])
            ;
        }
        return $posts;
    }
}