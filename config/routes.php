<?php

//HOMEPAGE
App\Router::get('/', 'App\Controller\HomeController@show')->name('home.show');
App\Router::get('/CV', 'App\Controller\HomeController@download')->name('home.download');
App\Router::post('/', 'App\Controller\MessageController@createMessage')->name('home.contact');

//BOLG PUBLIC-SIDE
App\Router::get('/blog', 'App\Controller\BlogController@index')->name('blog.index');
App\Router::get('/blog/user/{id}', 'App\Controller\BlogController@indexUser')->name('blog.indexUser');
App\Router::get('/blog/category/{id}', 'App\Controller\BlogController@indexCategory')->name('blog.indexCategory');
App\Router::get('/blog/post/show/{id}', 'App\Controller\BlogController@show')->name('blog.show');

//COMMENTS
App\Router::post('/comment/create', 'App\Controller\CommentController@createComment')->name('comment.createComment');
App\Router::get('/comment/delete/{id}/{postId}/{userId}', 'App\Controller\CommentController@delete')->name('comment.delete');


//AUTH
//views
App\Router::get('/user/login', 'App\Controller\LoginController@login')->name('user.login');
App\Router::get('/user/forgot', 'App\Controller\LoginController@forgot')->name('user.forgot');
App\Router::get('/user/register', 'App\Controller\LoginController@register')->name('user.register');
App\Router::get('/user/change/{username}/{token}', 'App\Controller\LoginController@change')->name('user.edit');

//method
App\Router::post('/user/signin', 'App\Controller\LoginController@signIn')->name('user.signin');
App\Router::get('/user/logout', 'App\Controller\LoginController@signOut')->name('user.logout');
App\Router::post('/user/signUp', 'App\Controller\LoginController@signUp')->name('user.signUp');
App\Router::post('/user/reset-password', 'App\Controller\MailController@resetPassword')->name('mail.reset');
App\Router::post('/user/change-password', 'App\Controller\LoginController@resetPassword')->name('user.change');

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
App\Router::get('/admin/dashboard/users/delete/{id}', 'App\Controller\UserController@deleteUser')->name('user.delete');
App\Router::get('/admin/dashboard/users/user/{name}/{id}', 'App\Controller\UserController@changeStatus')->name('admin.makeUser');
App\Router::get('/admin/dashboard/users/admin/{name}/{id}', 'App\Controller\UserController@changeStatus')->name('admin.makeAdmin');
//message
App\Router::get('/admin/dashboard/messages', 'App\Controller\AdminController@adminMessages')->name('admin.Messages');
App\Router::get('/admin/dashboard/messages/answered', 'App\Controller\AdminController@messagesUnanswered')->name('admin.messagesUnanswered');
App\Router::get('/admin/dashboard/messages/show/{id}', 'App\Controller\AdminController@showMessage')->name('admin.showMessage');
App\Router::get('/message/delete/{id}', 'App\Controller\MessageController@deleteMessage')->name('message.delete');
App\Router::post('/admin/dashboard/messages/answer/{id}', 'App\Controller\MailController@answerMessage')->name('admin.answerMessage');
