<?php

App\Router::get('/', 'App\Controller\HomeController@index');
App\Router::get('/blog/post/show/{id}', 'App\Controller\PostController@show');
App\Router::post('/blog/post/create', 'App\Controller\PostController@create');
