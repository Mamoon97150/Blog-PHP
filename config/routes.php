<?php

App\Router::get('/', 'App\Controller\HomeController@show')->name('home.show');
App\Router::post('/', 'App\Controller\HomeController@sendEmail');

App\Router::get('/blog', 'App\Controller\BlogController@index')->name('blog.index');
App\Router::get('/blog/user/{id}', 'App\Controller\BlogController@indexUser')->name('blog.indexUser');
App\Router::get('/blog/category/{id}', 'App\Controller\BlogController@indexCategory')->name('blog.indexCategory');
App\Router::get('/blog/post/show/{id}', 'App\Controller\BlogController@show')->name('blog.show');
App\Router::post('/blog/post/create', 'App\Controller\BlogController@create');

App\Router::get('/login', 'App\Controller\UserController@')->name('user.login');
