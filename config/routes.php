<?php

App\Router::get('/', 'App\Controller\HomeController@show')->name('home.show');
App\Router::post('/', 'App\Controller\HomeController@sendEmail');

App\Router::get('/blog', 'App\Controller\BlogController@index')->name('blog.index');
App\Router::get('/blog/user/{id}', 'App\Controller\BlogController@indexUser')->name('blog.indexUser');
App\Router::get('/blog/category/{id}', 'App\Controller\BlogController@indexCategory')->name('blog.indexCategory');
App\Router::get('/blog/post/show/{id}', 'App\Controller\BlogController@show')->name('blog.show');

App\Router::post('/comment/create', 'App\Controller\CommentController@createComment')->name('comment.createComment');
App\Router::get('/comment/delete/{id}/{postId}', 'App\Controller\CommentController@delete')->name('comment.delete');

App\Router::get('/user/login', 'App\Controller\UserController@login')->name('user.login');
App\Router::get('/user/forgot', 'App\Controller\UserController@forgot')->name('user.forgot');
App\Router::get('/user/register', 'App\Controller\UserController@register')->name('user.register');
App\Router::post('/user/signin', 'App\Controller\UserController@signIn')->name('user.signin');
App\Router::get('/user/logout', 'App\Controller\UserController@signOut')->name('user.logout');

App\Router::get('/admin/dashboard/{user}', 'App\Controller\AdminController@index')->name('admin.index');