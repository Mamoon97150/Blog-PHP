<?php

//HOMEPAGE
App\Router::get('/', 'App\Controller\HomeController@show')->name('home.show');
App\Router::post('/', 'App\Controller\HomeController@sendEmail');

//BOLG PUBLIC-SIDE
App\Router::get('/blog', 'App\Controller\BlogController@index')->name('blog.index');
App\Router::get('/blog/user/{id}', 'App\Controller\BlogController@indexUser')->name('blog.indexUser');
App\Router::get('/blog/category/{id}', 'App\Controller\BlogController@indexCategory')->name('blog.indexCategory');
App\Router::get('/blog/post/show/{id}', 'App\Controller\BlogController@show')->name('blog.show');

//COMMENTS
App\Router::post('/comment/create', 'App\Controller\CommentController@createComment')->name('comment.createComment');
App\Router::get('/comment/delete/{id}/{postId}', 'App\Controller\CommentController@delete')->name('comment.delete');


//AUTH
//views
App\Router::get('/user/login', 'App\Controller\LoginController@login')->name('user.login');
App\Router::get('/user/forgot', 'App\Controller\LoginController@forgot')->name('user.forgot');
App\Router::get('/user/register', 'App\Controller\LoginController@register')->name('user.register');
//method
App\Router::post('/user/signin', 'App\Controller\LoginController@signIn')->name('user.signin');
App\Router::get('/user/logout', 'App\Controller\LoginController@signOut')->name('user.logout');
App\Router::post('/user/signUp', 'App\Controller\LoginController@signUp')->name('user.signUp');
App\Router::post('/user/change-password', 'App\Controller\UserController@changePassword')->name('user.password');

//ADMIN DASHBOARD
//views
App\Router::get('/admin/dashboard', 'App\Controller\AdminController@index')->name('admin.index');
App\Router::get('/admin/dashboard/posts', 'App\Controller\AdminController@adminPost')->name('admin.adminPost');
App\Router::get('/admin/dashboard/posts/add', 'App\Controller\AdminController@addPost')->name('admin.addPost');
App\Router::get('/admin/dashboard/posts/edit/{id}', 'App\Controller\AdminController@editPost')->name('admin.editPost');
//posts
App\Router::post('/admin/dashboard/posts/create', 'App\Controller\PostController@createPost')->name('admin.createPost');
App\Router::post('/admin/dashboard/posts/update/{id}', 'App\Controller\PostController@updatePost')->name('admin.updatePost');
App\Router::get('/admin/dashboard/posts/delete/{id}', 'App\Controller\PostController@deletePost')->name('admin.deletePost');
//comments
App\Router::get('/admin/dashboard/comments', 'App\Controller\AdminController@adminComments')->name('admin.adminComments');
App\Router::get('/admin/dashboard/comments/pending', 'App\Controller\AdminController@pendingComments')->name('admin.pendingComments');
App\Router::get('/admin/dashboard/comments/approve/{id}', 'App\Controller\CommentController@approveComments')->name('admin.approveComments');
//users
App\Router::get('/admin/dashboard/users', 'App\Controller\AdminController@adminUsers')->name('admin.adminUsers');
App\Router::get('/admin/dashboard/users/admin', 'App\Controller\AdminController@manageAdmin')->name('admin.manageAdmin');
App\Router::get('/admin/dashboard/users/users', 'App\Controller\AdminController@manageUser')->name('admin.manageUser');
App\Router::get('/admin/dashboard/users/delete', 'App\Controller\UserController@deleteUser')->name('user.delete');
App\Router::get('/admin/dashboard/users/user/{id}', 'App\Controller\UserController@makeUser')->name('admin.makeUser');
App\Router::get('/admin/dashboard/users/admin/{id}', 'App\Controller\UserController@makeAdmin')->name('admin.makeAdmin');
